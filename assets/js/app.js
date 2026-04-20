/**
 * AutoKredit — Kalkulator Kredit Mobil
 * Minimalist, clean JavaScript
 */

"use strict";

// =========================================
// FORMAT RUPIAH
// =========================================
function formatRupiah(angka) {
  return 'Rp. ' + Math.round(angka).toLocaleString('id-ID');
}

function parseRupiah(str) {
  return parseFloat(str.replace(/[^\d]/g, '')) || 0;
}

// =========================================
// KALKULATOR
// =========================================
const Kalkulator = {

  validasi() {
    let ok = true;
    const harga = document.getElementById('hargaMobil');
    const dp    = document.getElementById('dp');
    const tenor = document.getElementById('tenor');

    [harga, dp, tenor].forEach(el => el.classList.remove('is-invalid'));

    if (parseRupiah(harga.value) <= 0) {
      harga.classList.add('is-invalid'); ok = false;
    }
    const dpVal = parseFloat(dp.value);
    if (isNaN(dpVal) || dpVal < 0 || dpVal > 99) {
      dp.classList.add('is-invalid'); ok = false;
    }
    const tenorVal = parseInt(tenor.value);
    if (isNaN(tenorVal) || tenorVal < 1 || tenorVal > 10) {
      tenor.classList.add('is-invalid'); ok = false;
    }

    return ok;
  },

  hitung() {
    if (!this.validasi()) return;

    const hargaMobil = parseRupiah(document.getElementById('hargaMobil').value);
    const dpPersen   = parseFloat(document.getElementById('dp').value);
    const tenorTahun = parseInt(document.getElementById('tenor').value);

    // Perhitungan
    const bunga       = hargaMobil * 0.20;
    const totalBunga  = hargaMobil + bunga;
    const nilaiDp     = hargaMobil * (dpPersen / 100);
    const tenorBulan  = tenorTahun * 12;
    const sisaHutang  = totalBunga - nilaiDp;
    const angsuran    = sisaHutang / tenorBulan;

    this.tampilkan({ hargaMobil, dpPersen, nilaiDp, tenorTahun, tenorBulan, bunga, angsuran });
  },

  tampilkan(d) {
    const el = document.getElementById('resultContainer');
    el.innerHTML = `
      <div class="result-animate">
        <div class="angsuran-box">
          <span class="angsuran-label">Angsuran per Bulan</span>
          <span class="angsuran-amount">${formatRupiah(d.angsuran)}</span>
          <span class="angsuran-sub">selama ${d.tenorBulan} bulan</span>
        </div>
        <div class="detail-table">
          <div class="d-row">
            <span class="d-key">Harga Mobil</span>
            <span class="d-val">${formatRupiah(d.hargaMobil)}</span>
          </div>
          <div class="d-row">
            <span class="d-key">DP (${d.dpPersen}%)</span>
            <span class="d-val">${formatRupiah(d.nilaiDp)}</span>
          </div>
          <div class="d-row">
            <span class="d-key">Tenor</span>
            <span class="d-val">${d.tenorTahun} Tahun (${d.tenorBulan} Bulan)</span>
          </div>
          <div class="d-row">
            <span class="d-key">Bunga</span>
            <span class="d-val accent">20% — ${formatRupiah(d.bunga)}</span>
          </div>
          <div class="d-total">
            <span class="d-key">Angsuran / Bulan</span>
            <span class="d-val">${formatRupiah(d.angsuran)}</span>
          </div>
        </div>
      </div>
    `;
  },

  reset() {
    document.getElementById('formKredit').reset();
    ['hargaMobil','dp','tenor'].forEach(id => {
      document.getElementById(id).classList.remove('is-invalid');
    });
    document.getElementById('resultContainer').innerHTML = `
      <div class="result-empty">
        <span class="result-empty-ring"></span>
        Isi formulir dan klik <strong>Hitung Angsuran</strong><br>untuk melihat hasil simulasi.
      </div>
    `;
  }
};

// =========================================
// FORMAT INPUT HARGA (titik ribuan)
// =========================================
function initHargaFormat() {
  const el = document.getElementById('hargaMobil');
  if (!el) return;

  el.addEventListener('input', function () {
    const raw = this.value.replace(/[^\d]/g, '');
    this.value = raw ? parseInt(raw, 10).toLocaleString('id-ID') : '';
  });
}

// =========================================
// BACK TO TOP
// =========================================
function initBackToTop() {
  const btn = document.getElementById('btnTop');
  if (!btn) return;
  window.addEventListener('scroll', () => btn.classList.toggle('show', scrollY > 350));
  btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// =========================================
// SMOOTH SCROLL + CLOSE MOBILE NAV
// =========================================
function initNav() {
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', function (e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      const offset = (document.querySelector('.navbar')?.offsetHeight || 60) + 8;
      window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
      document.querySelector('.navbar-collapse')?.classList.remove('show');
    });
  });
}

// =========================================
// ACTIVE NAV ON SCROLL
// =========================================
function initScrollSpy() {
  const sections = document.querySelectorAll('section[id]');
  const links    = document.querySelectorAll('.nav-link');
  const navH     = () => document.querySelector('.navbar')?.offsetHeight || 60;

  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(s => {
      if (scrollY >= s.offsetTop - navH() - 20) current = s.id;
    });
    links.forEach(l => {
      l.classList.toggle('active', l.getAttribute('href') === `#${current}`);
    });
  });
}

// =========================================
// KONTAK FORM
// =========================================
function initKontak() {
  const form = document.getElementById('formKontak');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    const btn = form.querySelector('.btn-send');
    btn.disabled = true;
    btn.textContent = 'Mengirim...';
    setTimeout(() => {
      form.reset();
      btn.disabled = false;
      btn.textContent = 'Kirim Pesan';
      const note = document.createElement('p');
      note.style.cssText = 'font-family:Trebuchet MS,sans-serif;font-size:.8rem;color:#2c7a2c;margin-top:10px;';
      note.textContent = 'Pesan berhasil dikirim. Kami akan segera menghubungi Anda.';
      form.appendChild(note);
      setTimeout(() => note.remove(), 4000);
    }, 1200);
  });
}

// =========================================
// INIT
// =========================================
document.addEventListener('DOMContentLoaded', () => {
  initHargaFormat();
  initBackToTop();
  initNav();
  initScrollSpy();
  initKontak();

  // Override form submit ke JS
  const form = document.getElementById('formKredit');
  if (form) {
    form.addEventListener('submit', e => {
      e.preventDefault();
      Kalkulator.hitung();
    });
  }
});
