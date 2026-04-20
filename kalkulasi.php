<?php
/**
 * AutoKredit — kalkulasi.php
 * Logika perhitungan kredit mobil (PHP native)
 *
 * Rumus:
 *   Bunga        = Harga Mobil × 20%
 *   Sisa Hutang  = (Harga Mobil + Bunga) - DP
 *   Angsuran/Bln = Sisa Hutang ÷ (Tenor × 12)
 */

function formatRupiah(float $n): string
{
    return 'Rp. ' . number_format((int) round($n), 0, ',', '.');
}

function sanitasiAngka(string $s): float
{
    return (float) preg_replace('/[^\d.]/', '', str_replace('.', '', $s));
}

function hitungKredit(float $harga, float $dpPersen, int $tenorTahun): array
{
    $bunga       = $harga * 0.20;
    $totalBunga  = $harga + $bunga;
    $nilaiDp     = $harga * ($dpPersen / 100);
    $tenorBulan  = $tenorTahun * 12;
    $sisaHutang  = $totalBunga - $nilaiDp;
    $angsuran    = $sisaHutang / $tenorBulan;

    return compact(
        'harga','dpPersen','nilaiDp',
        'tenorTahun','tenorBulan',
        'bunga','angsuran'
    );
}

// --- Proses POST ---
$result  = null;
$errors  = [];
$posted  = ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'hitung');

if ($posted) {
    $harga      = sanitasiAngka($_POST['harga_mobil'] ?? '0');
    $dpPersen   = (float) ($_POST['dp']    ?? 0);
    $tenorTahun = (int)   ($_POST['tenor'] ?? 0);

    if ($harga <= 0)                          $errors['harga']  = 'Harga mobil tidak valid.';
    if ($dpPersen < 0 || $dpPersen > 99)      $errors['dp']     = 'DP harus antara 0 – 99%.';
    if ($tenorTahun < 1 || $tenorTahun > 10)  $errors['tenor']  = 'Tenor harus 1 – 10 tahun.';

    if (empty($errors)) {
        $r = hitungKredit($harga, $dpPersen, $tenorTahun);
        $result = [
            'harga'       => $r['harga'],
            'dp_persen'   => $r['dpPersen'],
            'nilai_dp'    => $r['nilaiDp'],
            'tenor_tahun' => $r['tenorTahun'],
            'tenor_bulan' => $r['tenorBulan'],
            'bunga'       => $r['bunga'],
            'angsuran'    => $r['angsuran'],
            // formatted
            'f_harga'     => formatRupiah($r['harga']),
            'f_dp'        => formatRupiah($r['nilaiDp']),
            'f_bunga'     => formatRupiah($r['bunga']),
            'f_angsuran'  => formatRupiah($r['angsuran']),
        ];
    }
}

// Repopulate
$prevHarga = htmlspecialchars($_POST['harga_mobil'] ?? '', ENT_QUOTES);
$prevDp    = htmlspecialchars($_POST['dp']          ?? '', ENT_QUOTES);
$prevTenor = htmlspecialchars($_POST['tenor']       ?? '', ENT_QUOTES);
?>
