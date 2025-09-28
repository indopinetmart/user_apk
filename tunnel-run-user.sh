#!/bin/bash
# ============================================================
# 🚀 Laravel User Services + Cloudflare Quick Tunnel Runner
#    (Update USER_SERVICE_URL di Management)
# ============================================================

ROOT_DIR=$(pwd)
TUNNEL_LOG="$ROOT_DIR/tunnel.log"
TUNNEL_URL_FILE="$ROOT_DIR/tunnel-url.txt"
CLOUDFLARED_BIN="cloudflared"

# ------------------------------
# Container Laravel
# ------------------------------
USER_CONTAINER="user-app"
MANAGEMENT_CONTAINER="management-app"

# ------------------------------
# Nginx Gateway (publish 8082)
# ------------------------------
NGINX_HOST="localhost"
NGINX_PORT=8082

# ------------------------------
# Path .env
# ------------------------------
USER_ENV="$ROOT_DIR/.env"
MANAGEMENT_ENV="$ROOT_DIR/../management/.env"

# ------------------------------
# Warna log
# ------------------------------
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m'

log() { echo -e "$1"; }

# ------------------------------
# Cleanup saat CTRL+C
# ------------------------------
cleanup() {
  log "\n🛑 Menghentikan Cloudflare Tunnel..."
  pkill -f "cloudflared tunnel" >/dev/null 2>&1 || true
  exit 0
}
trap cleanup SIGINT SIGTERM

# ------------------------------
# Bersihkan cache Laravel
# ------------------------------
clear_laravel_cache() {
  log "⚡ Membersihkan cache Laravel..."
  docker exec -i $USER_CONTAINER php artisan optimize:clear || true
  docker exec -i $MANAGEMENT_CONTAINER php artisan optimize:clear || true
  log "✅ Cache Laravel dibersihkan"
}

# ------------------------------
# Hentikan tunnel lama
# ------------------------------
stop_old_tunnel() {
  log "🛑 Menghentikan tunnel lama..."
  pkill -f "cloudflared tunnel" >/dev/null 2>&1 || true
}

# ------------------------------
# Jalankan tunnel baru
# ------------------------------
start_tunnel() {
  log "🌐 Menjalankan Cloudflare Quick Tunnel ke $NGINX_HOST:$NGINX_PORT..."
  : > "$TUNNEL_LOG"
  nohup $CLOUDFLARED_BIN tunnel --url "http://$NGINX_HOST:$NGINX_PORT" --no-autoupdate > "$TUNNEL_LOG" 2>&1 &

  log "⏳ Menunggu tunnel aktif..."
  TUNNEL_URL=""
  TIMEOUT=60
  SECONDS=0
  while [ -z "$TUNNEL_URL" ] && [ $SECONDS -lt $TIMEOUT ]; do
    sleep 1
    TUNNEL_URL=$(grep -o 'https://[a-z0-9.-]*\.trycloudflare.com' "$TUNNEL_LOG" | tail -n 1)
  done

  if [ -z "$TUNNEL_URL" ]; then
    log "${RED}❌ Gagal mendapatkan URL tunnel${NC}"
    cleanup
  fi

  log "${GREEN}🔗 Tunnel aktif: $TUNNEL_URL${NC}"
}

# ------------------------------
# Update USER_SERVICE_URL di .env management
# ------------------------------
update_management_env() {
  if [ -f "$MANAGEMENT_ENV" ]; then
    if grep -q "^USER_SERVICE_URL=" "$MANAGEMENT_ENV"; then
      sed -i "s|^USER_SERVICE_URL=.*|USER_SERVICE_URL=$TUNNEL_URL|" "$MANAGEMENT_ENV"
    else
      echo "USER_SERVICE_URL=$TUNNEL_URL" >> "$MANAGEMENT_ENV"
    fi
    log "✅ USER_SERVICE_URL di management diperbarui"
  else
    log "⚠️ File .env management tidak ditemukan"
  fi
}

# ------------------------------
# Simpan URL tunnel
# ------------------------------
save_tunnel_url() {
  echo "$TUNNEL_URL" > "$TUNNEL_URL_FILE"
  log "📄 Tunnel URL disimpan → $TUNNEL_URL_FILE"
}

# ------------------------------
# Ambil credential DB dari .env user-services
# ------------------------------
load_db_credentials() {
  if [ ! -f "$USER_ENV" ]; then
    log "❌ File .env user-services tidak ditemukan, tidak bisa cek DB"
    exit 1
  fi

  DB_HOST=$(grep -E "^DB_HOST=" "$USER_ENV" | cut -d '=' -f2-)
  DB_PORT=$(grep -E "^DB_PORT=" "$USER_ENV" | cut -d '=' -f2-)
  DB_NAME=$(grep -E "^DB_DATABASE=" "$USER_ENV" | cut -d '=' -f2-)
  DB_USER=$(grep -E "^DB_USERNAME=" "$USER_ENV" | cut -d '=' -f2-)
  DB_PASS=$(grep -E "^DB_PASSWORD=" "$USER_ENV" | cut -d '=' -f2-)
}

# ------------------------------
# Cek koneksi Laravel ↔ Database
# ------------------------------
check_connection() {
  log "${YELLOW}==== PING Laravel ↔ Database ====${NC}"
  docker exec $USER_CONTAINER php -r "
    \$conn = @mysqli_connect('$DB_HOST','$DB_USER','$DB_PASS','$DB_NAME');
    echo \$conn ? '✅ Koneksi DB berhasil' : '❌ Gagal koneksi DB';
  "
  echo ""
}

# ------------------------------
# Tampilkan info akhir
# ------------------------------
show_info() {
  log "==============================================="
  log "🌍 URL Development (Cloudflare Quick Tunnel):"
  log "  - User Services → $TUNNEL_URL"
  log "==============================================="
  log "✅ Tunnel siap! Tekan CTRL+C untuk hentikan."
}

# ------------------------------
# Main Execution Flow
# ------------------------------
clear_laravel_cache
stop_old_tunnel
start_tunnel
update_management_env
save_tunnel_url
load_db_credentials
check_connection
docker exec -it $MANAGEMENT_CONTAINER php artisan config:clear
show_info
