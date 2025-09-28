<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Mock Marketplace — Lampu Sorot LED Taman</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#f6f7fb;
      --card:#ffffff;
      --muted:#6b7280;
      --primary:#0b61ff;
      --accent:#0f9d58;
      --radius:10px;
      --shadow: 0 6px 18px rgba(13,24,64,0.06);
      --gap:18px;
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      background:var(--bg);
      color:#111827;
      font-size:14px;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      line-height:1.35;
    }

    /* Container */
    .wrap{
      max-width:1280px;
      margin:28px auto;
      padding:0 20px;
    }

    /* Header */
    header.header{
      display:flex;
      align-items:center;
      gap:16px;
      margin-bottom:18px;
    }
    .logo{
      display:flex;
      align-items:center;
      gap:8px;
      text-decoration:none;
      color:var(--primary);
      font-weight:700;
      font-size:20px;
    }
    .logo .mark{
      width:44px;
      height:36px;
      background:linear-gradient(90deg,#2aa1ff,#0b61ff);
      border-radius:8px;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      color:white;
      font-weight:800;
      box-shadow:var(--shadow);
    }
    .search{
      flex:1;
      display:flex;
      gap:10px;
      align-items:center;
    }
    .search input[type="text"]{
      flex:1;
      padding:12px 14px;
      border-radius:10px;
      border:1px solid #e6e9ef;
      background:white;
      box-shadow:var(--shadow);
    }
    .btn{
      background:var(--primary);
      color:white;
      padding:10px 14px;
      border-radius:10px;
      border:none;
      cursor:pointer;
      font-weight:600;
    }

    /* Layout: sidebar + content */
    .layout{
      display:grid;
      grid-template-columns: 260px 1fr;
      gap:var(--gap);
      align-items:start;
    }

    /* Sidebar */
    aside.sidebar{
      background:white;
      border-radius:var(--radius);
      padding:18px;
      box-shadow:var(--shadow);
      height:fit-content;
    }
    .panel-title{
      font-weight:600;
      margin-bottom:10px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      font-size:15px;
    }
    .filter-group{
      margin-bottom:14px;
    }
    .checkbox{
      display:flex;
      gap:10px;
      align-items:center;
      margin:8px 0;
      color:var(--muted);
      font-size:13px;
    }
    .small{
      font-size:13px;
      color:var(--muted);
    }

    /* Content */
    .content-header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
      margin-bottom:12px;
    }
    .badges{
      display:flex;
      gap:10px;
      align-items:center;
    }
    .badge{
      background:white;
      padding:8px 12px;
      border-radius:999px;
      border:1px solid #eef2ff;
      box-shadow:0 3px 8px rgba(11,97,255,0.06);
      font-weight:600;
      color:var(--primary);
      font-size:13px;
    }

    .toolbar{
      display:flex;
      gap:12px;
      align-items:center;
    }
    .view-toggle button{
      background:white;
      border:1px solid #e6e9ef;
      padding:8px 10px;
      border-radius:8px;
      cursor:pointer;
    }

    /* Grid */
    .product-grid{
      display:grid;
      grid-template-columns: repeat(3,1fr);
      gap:18px;
    }
    .card{
      background:var(--card);
      border-radius:12px;
      overflow:hidden;
      box-shadow:var(--shadow);
      display:flex;
      flex-direction:column;
      min-height:220px;
    }
    .card img{
      width:100%;
      height:150px;
      object-fit:cover;
      display:block;
    }
    .card-body{
      padding:12px;
      flex:1;
      display:flex;
      flex-direction:column;
      gap:8px;
    }
    .title{
      font-weight:600;
      font-size:14px;
      color:#0f172a;
    }
    .meta{
      font-size:13px;
      color:var(--muted);
      display:flex;
      justify-content:space-between;
      align-items:center;
    }
    .price{
      color:#0b61ff;
      font-weight:700;
      font-size:16px;
    }
    .rating{
      display:flex;
      gap:6px;
      align-items:center;
      font-size:13px;
      color:var(--muted);
    }

    /* Footer / pagination (simple) */
    .pagination{
      margin-top:20px;
      display:flex;
      justify-content:center;
      gap:8px;
      align-items:center;
      color:var(--muted);
    }

    /* Responsive */
    @media (max-width:1000px){
      .layout{grid-template-columns: 1fr;}
      .product-grid{grid-template-columns: repeat(2,1fr);}
    }
    @media (max-width:640px){
      header.header{flex-direction:column; align-items:stretch; gap:10px}
      .product-grid{grid-template-columns: 1fr;}
      .logo{justify-content:center}
      .search input{width:100%}
    }
  </style>
</head>
<body>
  <div class="wrap">
    <header class="header">
      <a class="logo" href="#">
        <span class="mark">B</span>
        <span>blibli</span>
      </a>

      <div class="search" role="search">
        <input type="text" placeholder="Cari brand, produk, atau seller — mis: Lampu sorot LED taman">
        <button class="btn">Cari</button>
      </div>

      <div style="display:flex;gap:8px;align-items:center">
        <button class="btn" style="background:#fff;color:var(--primary);border:1px solid #e6e9ef">Masuk</button>
        <button class="btn" style="background:var(--accent)">Daftar</button>
      </div>
    </header>

    <section class="layout">
      <!-- SIDEBAR -->
      <aside class="sidebar" aria-label="Filter produk">
        <div class="panel-title"><span>Rating</span></div>
        <div class="filter-group">
          <label class="checkbox"><input type="radio" name="rating"> <span>⭐ 4 ke atas</span></label>
          <label class="checkbox"><input type="radio" name="rating"> <span>⭐ 3 ke atas</span></label>
        </div>

        <div class="panel-title"><span>Jarak & Lokasi Toko</span></div>
        <div class="filter-group small">
          <label class="checkbox"><input type="checkbox"> Kota Bandung</label>
          <label class="checkbox"><input type="checkbox"> DKI Jakarta</label>
          <label class="checkbox"><input type="checkbox"> Jabodetabek</label>
          <a href="#" style="display:inline-block;margin-top:8px;color:var(--primary);font-weight:600;font-size:13px">Lihat semua</a>
        </div>

        <div class="panel-title" style="margin-top:10px;"><span>Harga</span></div>
        <div class="filter-group small">
          <input type="text" placeholder="Rp Minimum" style="width:100%;padding:8px;border-radius:8px;border:1px solid #e6e9ef;margin-bottom:8px">
          <input type="text" placeholder="Rp Maksimum" style="width:100%;padding:8px;border-radius:8px;border:1px solid #e6e9ef">
        </div>
      </aside>

      <!-- MAIN CONTENT -->
      <main>
        <div class="content-header">
          <div class="badges">
            <div class="badge">Pasti ori</div>
            <div class="badge">Retur alasan apa pun</div>
            <div class="badge">Jaminan tepat waktu</div>
          </div>

          <div class="toolbar">
            <div class="view-toggle" title="Ubah tampilan">
              <button id="gridBtn" aria-pressed="true">🔳</button>
              <button id="listBtn">☰</button>
            </div>
            <div style="margin-left:6px">
              <select id="sortSel" style="padding:8px;border-radius:8px;border:1px solid #e6e9ef">
                <option>Relevansi</option>
                <option>Harga: Terendah</option>
                <option>Harga: Tertinggi</option>
                <option>Penjualan</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Info -->
        <div style="background:white;border-radius:12px;padding:18px;margin-bottom:12px;box-shadow:var(--shadow)">
          <div style="color:var(--muted)">Ini hasil dari semua kategori. Tandai kategori untuk pencarian lebih spesifik.</div>
        </div>

        <!-- GRID -->
        <section class="product-grid" id="productGrid">
          <!-- Card: contoh, bisa di-generate oleh backend -->
          <!-- 1 -->
          <article class="card">
            <img src="https://placehold.co/600x400?text=Lampu+Sorot+LED+Taman+1" alt="produk 1">
            <div class="card-body">
              <div class="title">Lampu Sorot LED Taman Hias Dekorasi Floodlight 20W</div>
              <div class="meta">
                <div class="price">Rp158.900</div>
                <div class="rating">⭐ 4.8 • Kota Jakarta Barat</div>
              </div>
            </div>
          </article>

          <!-- 2 -->
          <article class="card">
            <img src="https://placehold.co/600x400?text=Lampu+Taman+2" alt="produk 2">
            <div class="card-body">
              <div class="title">RAIBOHO Lampu Taman Ground Light Solar Sensor</div>
              <div class="meta">
                <div class="price">Rp42.999</div>
                <div class="rating">⭐ 4.3 • Kota Jakarta Selatan</div>
              </div>
            </div>
          </article>

          <!-- 3 -->
          <article class="card">
            <img src="https://placehold.co/600x400?text=Lampu+Taman+3" alt="produk 3">
            <div class="card-body">
              <div class="title">Lampu Taman Hias Ground Light Solar Waterproof</div>
              <div class="meta">
                <div class="price">Rp41.999</div>
                <div class="rating">⭐ 4.7 • Kota Jakarta Selatan</div>
              </div>
            </div>
          </article>

          <!-- 4 -->
          <article class="card">
            <img src="https://placehold.co/600x400?text=Lampu+Taman+4" alt="produk 4">
            <div class="card-body">
              <div class="title">Lampu Taman Ground Light - Spotlight</div>
              <div class="meta">
                <div class="price">Rp65.999</div>
                <div class="rating">⭐ 4.5 • Kota Jakarta Selatan</div>
              </div>
            </div>
          </article>

          <!-- 5 -->
          <article class="card">
            <img src="https://placehold.co/600x400?text=Lampu+Taman+5" alt="produk 5">
            <div class="card-body">
              <div class="title">Lampu Sorot Taman Outdoor Waterproof</div>
              <div class="meta">
                <div class="price">Rp59.900</div>
                <div class="rating">⭐ 4.4 • Kota Tangerang</div>
              </div>
            </div>
          </article>

          <!-- 6 -->
          <article class="card">
            <img src="https://placehold.co/600x400?text=Lampu+Taman+6" alt="produk 6">
            <div class="card-body">
              <div class="title">Lampu Hias Taman LED RGB Solar</div>
              <div class="meta">
                <div class="price">Rp129.000</div>
                <div class="rating">⭐ 4.6 • Kota Surabaya</div>
              </div>
            </div>
          </article>
        </section>

        <div class="pagination">
          <button class="btn" style="background:white;color:var(--primary);border:1px solid #e6e9ef">«</button>
          <div>1</div>
          <div>2</div>
          <div>3</div>
          <button class="btn" style="background:white;color:var(--primary);border:1px solid #e6e9ef">»</button>
        </div>
      </main>
    </section>
  </div>

  <script>
    // Simple JS untuk toggle tampilan grid/list dan sort placeholder
    const gridBtn = document.getElementById('gridBtn');
    const listBtn = document.getElementById('listBtn');
    const grid = document.getElementById('productGrid');
    const sortSel = document.getElementById('sortSel');

    gridBtn.addEventListener('click', () => {
      grid.style.display = 'grid';
      gridBtn.setAttribute('aria-pressed','true');
      listBtn.setAttribute('aria-pressed','false');
    });

    listBtn.addEventListener('click', () => {
      grid.style.display = 'block';
      // simple "list" style by making each card full width
      Array.from(grid.children).forEach(card => {
        card.style.display = 'flex';
        card.style.gap = '12px';
        card.querySelector('img').style.width = '260px';
        card.querySelector('img').style.height = '160px';
        card.style.alignItems = 'center';
      });
      listBtn.setAttribute('aria-pressed','true');
      gridBtn.setAttribute('aria-pressed','false');
    });

    // revert list -> grid when window resized or when gridBtn clicked
    window.addEventListener('resize', ()=> {
      if (window.innerWidth < 640) {
        Array.from(grid.children).forEach(card => {
          card.style.display='';
          card.querySelector('img').style.width='';
          card.querySelector('img').style.height='';
        });
      }
    });

    gridBtn.addEventListener('click', ()=> {
      Array.from(grid.children).forEach(card => {
        card.style.display='';
        card.querySelector('img').style.width='';
        card.querySelector('img').style.height='';
      });
    });

    sortSel.addEventListener('change', (e)=> {
      // placeholder: di integrasi backend, ini akan minta data terurut
      alert('Sort: ' + e.target.value + '\nIni demo; implementasikan fetch ke API untuk urutan sebenarnya.');
    });
  </script>
</body>
</html>
