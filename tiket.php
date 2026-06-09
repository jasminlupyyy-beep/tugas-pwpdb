<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$harga = [
    'GRD' => [
        'nama' => 'Garuda',
        'Eksekutif' => 1500000,
        'Bisnis' => 900000,
        'Ekonomi' => 500000
    ],
    'MPT' => [
        'nama' => 'Merpati',
        'Eksekutif' => 1200000,
        'Bisnis' => 800000,
        'Ekonomi' => 400000
    ],
    'BTV' => [
        'nama' => 'Batavia',
        'Eksekutif' => 1000000,
        'Bisnis' => 700000,
        'Ekonomi' => 300000
    ]
];

$result = null;

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $kode   = $_POST['kode'];
    $kelas  = $_POST['kelas'];
    $jumlah = (int)$_POST['jumlah'];

    $namaPesawat = $harga[$kode]['nama'];
    $hargaTiket  = $harga[$kode][$kelas];
    $totalBayar  = $hargaTiket * $jumlah;

    $result = [
        'nama' => $nama,
        'pesawat' => $namaPesawat,
        'kelas' => $kelas,
        'harga' => $hargaTiket,
        'jumlah' => $jumlah,
        'total' => $totalBayar
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Travelok Ticket</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    min-height: 100vh;
    background: radial-gradient(circle at top right, #1e3a8a, #0f172a);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
    color: #f8fafc;
}

.wrap {
    width: 100%;
    max-width: 1000px;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 30px;
}

.card {
    background: rgba(30, 41, 59, 0.7);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 35px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.brand {
    font-size: 32px;
    font-weight: 700;
    letter-spacing: -0.5px;
    color: #38bdf8;
    margin-bottom: 4px;
}

.sub {
    font-size: 14px;
    color: #94a3b8;
    margin-bottom: 30px;
}

label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #cbd5e1;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

input[type="text"], select {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    outline: none;
    border-radius: 12px;
    margin-bottom: 20px;
    background: rgba(15, 23, 42, 0.6);
    color: #fff;
    font-size: 15px;
    transition: all 0.3s ease;
}

input[type="text"]:focus, select:focus {
    border-color: #38bdf8;
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
}

select option {
    background-color: #1e293b;
    color: #fff;
}

/* Custom Horizontal Radio Buttons */
.radio-box {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.radio-option {
    flex: 1;
    min-width: 100px;
    position: relative;
}

.radio-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.radio-label {
    display: block;
    text-align: center;
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 12px 10px;
    border-radius: 12px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    color: #94a3b8;
    transition: all 0.2s ease;
}

.radio-option input[type="radio"]:checked + .radio-label {
    background: rgba(56, 189, 248, 0.15);
    border-color: #38bdf8;
    color: #38bdf8;
    font-weight: 600;
}

button {
    padding: 15px 20px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.2s ease;
}

.btn {
    background: linear-gradient(135deg, #38bdf8, #0284c7);
    color: #fff;
    width: 100%;
    box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
    margin-top: 10px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
}

.btn:active {
    transform: translateY(0);
}

.logout {
    display: inline-block;
    margin-top: 20px;
    font-size: 14px;
    color: #ef4444;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}

.logout:hover {
    color: #f87171;
    text-decoration: underline;
}

/* Boarding Pass Ticket Style Layout */
.ticket-box {
    background: #fff;
    color: #0f172a;
    border-radius: 16px;
    padding: 24px;
    position: relative;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.ticket-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 16px;
}

.ticket-item label {
    color: #64748b;
    font-size: 11px;
    margin-bottom: 2px;
}

.ticket-item .val {
    font-size: 16px;
    font-weight: 600;
    color: #0f172a;
}

.ticket-divider {
    border-top: 2px dashed #cbd5e1;
    margin: 20px 0;
    position: relative;
}

/* Efek potongan tiket di kanan-kiri lubang separator */
.ticket-divider::before, .ticket-divider::after {
    content: '';
    position: absolute;
    top: -8px;
    width: 16px;
    height: 16px;
    background: #19243a; /* Menyesuaikan warna luar box */
    border-radius: 50%;
}
.ticket-divider::before { left: -33px; }
.ticket-divider::after { right: -33px; }

.total-section {
    text-align: right;
}

.total-section label {
    color: #64748b;
    font-size: 12px;
}

.total-price {
    font-size: 26px;
    color: #0284c7;
    font-weight: 700;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #94a3b8;
    border: 2px dashed rgba(255,255,255,0.1);
    border-radius: 16px;
}

@media(max-width:850px){
    .wrap{
        grid-template-columns:1fr;
    }
}
</style>
</head>
<body>

<div class="wrap">

    <div class="card">
        <div>
            <div class="brand">Travelok</div>
            <div class="sub">Pesan tiket Jakarta ke Malaysia</div>

            <form method="post">
                <label>Nama Penumpang</label>
                <input type="text" name="nama" placeholder="Masukkan nama sesuai paspor" required>

                <label>Kode Pesawat</label>
                <select name="kode">
                    <option value="GRD">GRD - Garuda</option>
                    <option value="MPT">MPT - Merpati</option>
                    <option value="BTV">BTV - Batavia</option>
                </select>

                <label>Kelas</label>
                <div class="radio-box">
                    <div class="radio-option">
                        <input type="radio" name="kelas" id="ex" value="Eksekutif" checked>
                        <label for="ex" class="radio-label">Eksekutif</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="kelas" id="bs" value="Bisnis">
                        <label for="bs" class="radio-label">Bisnis</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="kelas" id="ek" value="Ekonomi">
                        <label for="ek" class="radio-label">Ekonomi</label>
                    </div>
                </div>

                <label>Jumlah Tiket</label>
                <select name="jumlah">
                    <?php
                    for($i=1;$i<=10;$i++){
                        echo "<option value='$i'>$i Tiket</option>";
                    }
                    ?>
                </select>

                <button class="btn" type="submit" name="simpan">Pesan Sekarang</button>
            </form>
        </div>
        <div>
            <a href="logout.php" class="logout">Logout dari Akun</a>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="brand" style="color: #fff;">Detail Ticket</div>
            <div class="sub">Informasi struk pemesanan Anda</div>

            <?php if($result): ?>
                <div class="ticket-box">
                    <div class="ticket-row">
                        <div class="ticket-item">
                            <label>NAMA PENUMPANG</label>
                            <div class="val"><?= htmlspecialchars($result['nama']); ?></div>
                        </div>
                    </div>
                    
                    <div class="ticket-row">
                        <div class="ticket-item">
                            <label>MASKAPAI</label>
                            <div class="val"><?= $result['pesawat']; ?></div>
                        </div>
                        <div class="ticket-item" style="text-align: right;">
                            <label>KELAS</label>
                            <div class="val"><?= $result['kelas']; ?></div>
                        </div>
                    </div>

                    <div class="ticket-row">
                        <div class="ticket-item">
                            <label>HARGA SATUAN</label>
                            <div class="val">Rp <?= number_format($result['harga'],0,',','.'); ?></div>
                        </div>
                        <div class="ticket-item" style="text-align: right;">
                            <label>JUMLAH</label>
                            <div class="val">x <?= $result['jumlah']; ?></div>
                        </div>
                    </div>

                    <div class="ticket-divider"></div>

                    <div class="total-section">
                        <label>TOTAL PEMBAYARAN</label>
                        <div class="total-price">Rp <?= number_format($result['total'],0,',','.'); ?></div>
                    </div>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Belum ada pemesanan tiket aktif.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>