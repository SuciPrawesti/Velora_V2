<?php
/**
 * AutoKredit — index.php
 * Sistem Kalkulator Kredit Mobil
 * LSP Teknologi Digital — Universitas Brawijaya 2024
 */
require_once __DIR__ . '/kalkulasi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AutoKredit — Kalkulator Kredit Mobil</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>


<!-- ============================================================
     NAVBAR
     ============================================================ -->
<nav class="navbar navbar-expand-lg">
  <div class="container">

    <a class="navbar-brand" href="#beranda">
      <img src="assets/img/Velora_logo.png" alt="Velora Logo" class="navbar-logo-img">
      <div>
        <span class="brand-name">Velora</span>
        <span class="brand-sub">Kalkulator Kredit Mobil</span>
      </div>
    </a>

    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="#beranda">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Perusahaan</a></li>
        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak Perusahaan</a></li>
      </ul>
    </div>

  </div>
</nav>


<!-- ============================================================
     SLIDER
     ============================================================ -->
<div id="slider" class="carousel slide hero-slider" data-bs-ride="carousel" data-bs-interval="5000">

  <div class="carousel-indicators">
    <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#slider" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#slider" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="assets/img/slider1.png" class="slide-bg" alt="Slide 1">
      <div class="slide-overlay">
        <div class="container">
          <div class="slide-content">
            <span class="slide-label">Simulasi Kredit Mobil</span>
            <h2 class="slide-title">Hitung Cicilan Mobil<br>Impian <em>Anda</em></h2>
            <p class="slide-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere vel alias odit iste consequatur ipsam optio maiores suscipit.</p>
            <a href="#beranda" class="btn-slide">Mulai Hitung</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="assets/img/slider2.png" class="slide-bg" alt="Slide 2">
      <div class="slide-overlay" style="background:linear-gradient(to right,rgba(27,45,69,.92) 45%,rgba(27,45,69,.4) 100%);">
        <div class="container">
          <div class="slide-content">
            <span class="slide-label">Bunga Transparan</span>
            <h2 class="slide-title">Bunga <em>20% Flat</em><br>Tanpa Biaya Tersembunyi</h2>
            <p class="slide-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore dolor voluptas facere vel alias odit iste consequatur ipsam optio.</p>
            <a href="#beranda" class="btn-slide">Coba Kalkulator</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="assets/img/slider3.png" class="slide-bg" alt="Slide 3">
      <div class="slide-overlay" style="background:linear-gradient(to right,rgba(8,14,28,.95) 45%,rgba(8,14,28,.45) 100%);">
        <div class="container">
          <div class="slide-content">
            <span class="slide-label">Proses Mudah</span>
            <h2 class="slide-title">Tiga Langkah<br>Hasil <em>Langsung</em></h2>
            <p class="slide-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam nemo blanditiis distinctio error impedit dolorem voluptas facere vel alias.</p>
            <a href="#beranda" class="btn-slide">Mulai Sekarang</a>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.carousel-inner -->

  <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div><!-- end slider -->


<!-- ============================================================
     BERANDA — KALKULATOR KREDIT
     ============================================================ -->
<section id="beranda">
  <div class="container">

    <div class="mb-4">
      <span class="section-label">Simulasi Kredit Mobil</span>
      <h2 class="section-title">Kalkulator Angsuran</h2>
      <div class="section-line"></div>
    </div>

    <div class="row g-4 align-items-start">

      <!-- Form Input -->
      <div class="col-lg-6">
        <div class="card-panel">

          <div class="panel-header">
            <h5>Data Kredit</h5>
            <small>Isi kolom di bawah untuk menghitung simulasi angsuran</small>
          </div>

          <div class="panel-body">

            <?php if ($posted && !empty($errors)): ?>
            <div class="bunga-note" style="border-left-color:#c0392b;background:#fdf0f0;color:#8a1a1a;margin-bottom:16px;">
              <?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="#beranda" id="formKredit" novalidate>
              <input type="hidden" name="action" value="hitung" />

              <!-- Harga Mobil -->
              <div class="mb-3">
                <label for="hargaMobil" class="form-label">Harga Mobil</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="text" class="form-control <?= isset($errors['harga']) ? 'is-invalid' : '' ?>"
                         id="hargaMobil" name="harga_mobil"
                         placeholder="Contoh: 250.000.000"
                         value="<?= $prevHarga ?>"
                         autocomplete="off" required />
                  <div class="invalid-feedback">Harga mobil tidak valid.</div>
                </div>
                <p class="form-hint">Masukkan harga kendaraan yang ingin dikreditkan</p>
              </div>

              <!-- DP -->
              <div class="mb-3">
                <label for="dp" class="form-label">DP — Uang Muka (%)</label>
                <div class="input-group">
                  <input type="number" class="form-control <?= isset($errors['dp']) ? 'is-invalid' : '' ?>"
                         id="dp" name="dp"
                         placeholder="Contoh: 20"
                         min="0" max="99" step="1"
                         value="<?= $prevDp ?>" required />
                  <span class="input-group-text">%</span>
                  <div class="invalid-feedback">DP harus antara 0 – 99%.</div>
                </div>
                <p class="form-hint">Persentase uang muka dari harga mobil</p>
              </div>

              <!-- Tenor -->
              <div class="mb-4">
                <label for="tenor" class="form-label">Tenor (Tahun)</label>
                <div class="input-group">
                  <input type="number" class="form-control <?= isset($errors['tenor']) ? 'is-invalid' : '' ?>"
                         id="tenor" name="tenor"
                         placeholder="Contoh: 5"
                         min="1" max="10" step="1"
                         value="<?= $prevTenor ?>" required />
                  <span class="input-group-text">Tahun</span>
                  <div class="invalid-feedback">Tenor harus 1 – 10 tahun.</div>
                </div>
                <p class="form-hint">Akan dikonversi ke bulan (1 tahun = 12 bulan)</p>
              </div>

              <!-- Keterangan Bunga -->
              <div class="bunga-note">
                Bunga ditetapkan sebesar <strong>20% flat</strong> dari harga mobil.
              </div>

              <button type="submit" class="btn-hitung">Hitung Angsuran</button>
              <button type="reset" class="btn-reset" onclick="Kalkulator.reset()">Reset</button>

            </form>

          </div>
        </div>
      </div>

      <!-- Hasil Perhitungan -->
      <div class="col-lg-6">
        <div class="card-panel">

          <div class="panel-header">
            <h5>Hasil Perhitungan</h5>
            <small>Rincian simulasi angsuran kredit Anda</small>
          </div>

          <div id="resultContainer">

            <?php if ($result): ?>
            <!-- PHP Result (no-JS fallback) -->
            <div class="result-animate">
              <div class="angsuran-box">
                <span class="angsuran-label">Angsuran per Bulan</span>
                <span class="angsuran-amount"><?= $result['f_angsuran'] ?></span>
                <span class="angsuran-sub">selama <?= $result['tenor_bulan'] ?> bulan</span>
              </div>
              <div class="detail-table">
                <div class="d-row">
                  <span class="d-key">Harga Mobil</span>
                  <span class="d-val"><?= $result['f_harga'] ?></span>
                </div>
                <div class="d-row">
                  <span class="d-key">DP (<?= $result['dp_persen'] ?>%)</span>
                  <span class="d-val"><?= $result['f_dp'] ?></span>
                </div>
                <div class="d-row">
                  <span class="d-key">Tenor</span>
                  <span class="d-val"><?= $result['tenor_tahun'] ?> Tahun (<?= $result['tenor_bulan'] ?> Bulan)</span>
                </div>
                <div class="d-row">
                  <span class="d-key">Bunga</span>
                  <span class="d-val accent">20% — <?= $result['f_bunga'] ?></span>
                </div>
                <div class="d-total">
                  <span class="d-key">Angsuran / Bulan</span>
                  <span class="d-val"><?= $result['f_angsuran'] ?></span>
                </div>
              </div>
            </div>

            <?php else: ?>
            <!-- Kosong -->
            <div class="result-empty">
              <span class="result-empty-ring"></span>
              Isi formulir dan klik <strong>Hitung Angsuran</strong><br>untuk melihat hasil simulasi.
            </div>
            <?php endif; ?>

          </div><!-- /#resultContainer -->

        </div>
      </div>

    </div><!-- /.row -->
  </div>
</section>


<!-- ============================================================
     TENTANG PERUSAHAAN
     ============================================================ -->
<section id="tentang">
  <div class="container">

    <div class="mb-4">
      <span class="section-label">Profil</span>
      <h2 class="section-title">Tentang Perusahaan</h2>
      <div class="section-line"></div>
    </div>

    <div class="row g-4">

      <div class="col-lg-7">
        <div class="about-text">
          <p>
            <strong>Lorem</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Labore, dolor voluptas. Facere vel, alias odit iste, consequatur ipsam optio maiores suscipit 
            expedita ea blanditiis eius delectus
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Labore, dolor voluptas. Facere vel, alias odit iste, consequatur ipsam optio maiores suscipit 
              </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Labore, dolor voluptas. Facere vel, alias odit iste, consequatur ipsam optio maiores suscipit 
            expedita ea blanditiis eius delectus
          </p>
        </div>
        <div class="value-tags">
          <span class="tag">Lorem ipsum</span>
          <span class="tag">Lorem ipsum</span>
          <span class="tag">Lorem ipsum</span>
          <span class="tag">Lorem ipsum</span>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="info-grid">
          <div class="info-box">
            <strong>Lorem</strong>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Labore</p>
          </div>
          <div class="info-box">
            <strong>Lorem</strong>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Labore</p>
          </div>
          <div class="info-box">
            <strong>Lorem</strong>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Labore</p>
          </div>
          <div class="info-box">
            <strong>Lorem</strong>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Labore</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     KONTAK PERUSAHAAN
     ============================================================ -->
<section id="kontak">
  <div class="container">

    <div class="mb-4">
      <span class="section-label">Hubungi Kami</span>
      <h2 class="section-title">Kontak Perusahaan</h2>
      <div class="section-line"></div>
    </div>

    <div class="row g-4">

      <!-- Info Kontak -->
      <div class="col-lg-5">
        <div class="contact-info">
          <h5>Informasi Kontak</h5>
          <span class="sub">Senin – Jumat, 08.00 – 17.00 WIB</span>

          <div class="c-item">
            <div class="c-dot"></div>
            <div class="c-text">
              <strong>Alamat</strong>
              <span>Jl. Lorem No. 10, Ipsum,<br>Lorem ipsum 12345</span>
            </div>
          </div>

          <div class="c-item">
            <div class="c-dot"></div>
            <div class="c-text">
              <strong>Telepon</strong>
              <span>+62 341 123 4567</span>
            </div>
          </div>

          <div class="c-item">
            <div class="c-dot"></div>
            <div class="c-text">
              <strong>WhatsApp</strong>
              <span>+62 812 3456 7890</span>
            </div>
          </div>

          <div class="c-item">
            <div class="c-dot"></div>
            <div class="c-text">
              <strong>Email</strong>
              <span>info@Velora.id</span>
            </div>
          </div>

        </div>
      </div>

      <!-- Form Kontak -->
      <div class="col-lg-7">
        <div class="contact-form-wrap">
          <h5>Kirim Pesan</h5>

          <form id="formKontak" novalidate>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Nama Anda" required />
              </div>
              <div class="col-sm-6">
                <label class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" placeholder="+62 xxx xxxx xxxx" required />
              </div>
              <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="email@contoh.com" required />
              </div>
              <div class="col-12">
                <label class="form-label">Pesan</label>
                <textarea class="form-control" rows="4"
                          placeholder="Tuliskan pertanyaan atau kebutuhan Anda..." required></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-send">Kirim Pesan</button>
              </div>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     FOOTER
     ============================================================ -->
<footer>
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-4 col-md-6">
        <div class="footer-brand">
          <img src="assets/img/Velora_logo.png" alt="Velora Logo" class="navbar-logo-img">
          <div class="footer-brand-text">
            <span class="footer-name">Velora</span>
            <p class="footer-desc">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam nemo blanditiis distinctio error impedit dolorem
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-6">
        <p class="footer-heading">Menu</p>
        <ul class="footer-links">
          <li><a href="#beranda">Beranda</a></li>
          <li><a href="#tentang">Tentang Perusahaan</a></li>
          <li><a href="#kontak">Kontak Perusahaan</a></li>
        </ul>
      </div>

      <div class="col-lg-5 col-md-3 col-6">
        <p class="footer-heading">Kontak</p>
        <span class="footer-contact-text">Jl. Lorem No. 10, Ipsum,<br>Lorem ipsum 12345</span>
        <span class="footer-contact-text">+62 0831 123 4567</span>
        <span class="footer-contact-text">info@Velora.id</span>
      </div>

    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <p>&copy; <?= date('Y') ?> Velora. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <p>Uji Kompetensi LSP Teknologi Digital — Universitas Brawijaya 2024</p>
        </div>
      </div>
    </div>
  </div>
</footer>


<!-- Back to Top -->
<button id="btnTop" class="btn-top" aria-label="Ke atas">&#9650;</button>


<!-- Scripts (Bootstrap + App — 100% Offline) -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>

</body>
</html>