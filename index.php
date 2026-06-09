<?php
include 'koneksi.php';
session_start();

$loginMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email)) {
        $loginMessage = 'Harap masukkan email Anda';
    } elseif (empty($password)) {
        $loginMessage = 'Harap masukkan kata sandi';
    } else {

        // contoh login sederhana
        $_SESSION['email'] = $email;

        header("Location: tiket.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travelok Login</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
    
    * { 
      box-sizing: border-box; 
      margin: 0; 
      padding: 0; 
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      min-height: 100vh;
      background: radial-gradient(circle at top right, #1e3a8a, #0f172a);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      overflow-x: hidden;
    }

    .wrap {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .stars {
      position: absolute; 
      top: 0; 
      left: 0; 
      right: 0; 
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }

    .star {
      position: absolute;
      background: white;
      border-radius: 50%;
      animation: twinkle 3s infinite alternate;
    }

    @keyframes twinkle { 
      from { opacity: 0.1; } 
      to { opacity: 0.8; } 
    }

    .login-panel {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 440px;
      background: rgba(30, 41, 59, 0.7);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 24px;
      padding: 40px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    .brand {
      display: flex; 
      align-items: center; 
      gap: 12px;
      margin-bottom: 30px;
    }

    .brand-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #38bdf8, #0284c7);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
    }

    .brand-name {
      font-size: 24px; 
      font-weight: 700;
      color: #38bdf8; 
      letter-spacing: -0.5px;
    }

    .form-title {
      font-size: 28px; 
      font-weight: 700;
      color: #fff;
      margin-bottom: 6px;
      letter-spacing: -0.5px;
    }

    .form-sub {
      font-size: 14px; 
      font-weight: 400;
      color: #94a3b8;
      margin-bottom: 32px;
    }

    .field-group { 
      margin-bottom: 20px; 
    }

    .field-label {
      display: block;
      font-size: 12px; 
      font-weight: 600;
      letter-spacing: 0.5px; 
      text-transform: uppercase;
      color: #cbd5e1;
      margin-bottom: 8px;
    }

    .field-wrap { 
      position: relative; 
    }

    .field-input {
      width: 100%;
      padding: 14px 16px 14px 44px;
      background: rgba(15, 23, 42, 0.6);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 12px;
      font-size: 15px; 
      color: #fff;
      font-family: inherit;
      outline: none;
      transition: all 0.3s ease;
    }

    .field-input::placeholder { 
      color: #64748b; 
    }

    .field-input:focus {
      border-color: #38bdf8;
      background: rgba(15, 23, 42, 0.8);
      box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    }

    .fi { 
      position: absolute; 
      left: 16px; 
      top: 50%; 
      transform: translateY(-50%); 
      font-size: 16px; 
      pointer-events: none; 
      opacity: 0.7;
    }

    .eye-btn {
      position: absolute; 
      right: 16px; 
      top: 50%; 
      transform: translateY(-50%);
      background: none; 
      border: none; 
      cursor: pointer;
      font-size: 16px; 
      color: rgba(255,255,255,0.4);
      transition: color 0.2s; 
      padding: 0;
    }
    .eye-btn:hover { 
      color: #fff; 
    }

    .options-row {
      display: flex; 
      justify-content: space-between; 
      align-items: center;
      margin-bottom: 28px;
    }

    .check-label {
      display: flex; 
      align-items: center; 
      gap: 8px;
      font-size: 14px; 
      color: #94a3b8; 
      cursor: pointer;
    }
    .check-label input { 
      accent-color: #38bdf8; 
      cursor: pointer; 
      width: 16px;
      height: 16px;
    }

    .forgot { 
      font-size: 14px; 
      color: #38bdf8; 
      text-decoration: none; 
      font-weight: 500;
    }
    .forgot:hover { 
      text-decoration: underline; 
    }

    .submit-btn {
      width: 100%; 
      padding: 15px;
      background: linear-gradient(135deg, #38bdf8, #0284c7);
      border: none; 
      border-radius: 12px;
      font-size: 16px; 
      font-weight: 600;
      color: #fff;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
    }
    .submit-btn:hover { 
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
    }
    .submit-btn:active { 
      transform: translateY(0); 
    }

    .sep { 
      display: flex; 
      align-items: center; 
      gap: 12px; 
      margin: 24px 0; 
    }
    .sep-line { 
      flex: 1; 
      height: 1px; 
      background: rgba(255,255,255,0.1); 
    }
    .sep-txt { 
      font-size: 13px; 
      color: #64748b; 
    }

    .social-row { 
      display: flex; 
      gap: 12px; 
    }

    .soc-btn {
      flex: 1; 
      padding: 12px;
      background: rgba(15, 23, 42, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      font-size: 14px; 
      color: #cbd5e1;
      font-family: inherit; 
      cursor: pointer;
      display: flex; 
      align-items: center; 
      justify-content: center; 
      gap: 8px;
      transition: all 0.2s;
    }
    .soc-btn:hover { 
      background: rgba(255, 255, 255, 0.08); 
      color: #fff; 
      border-color: rgba(255,255,255,0.2);
    }

    .signup-row { 
      text-align: center; 
      margin-top: 28px; 
      font-size: 14px; 
      color: #94a3b8; 
    }
    .signup-row a { 
      color: #38bdf8; 
      text-decoration: none; 
      font-weight: 600; 
    }
    .signup-row a:hover {
      text-decoration: underline;
    }

    .toast {
      position: fixed; 
      top: 24px; 
      right: 24px; 
      z-index: 999;
      background: #1e293b;
      border: 1px solid rgba(239, 68, 68, 0.5);
      border-left: 4px solid #ef4444;
      border-radius: 12px; 
      padding: 16px 20px;
      font-size: 14px; 
      color: #f8fafc;
      opacity: 0; 
      transform: translateY(-10px);
      transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55); 
      pointer-events: none;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }
    .toast.show { 
      opacity: 1; 
      transform: translateY(0); 
    }
  </style>
</head>
<body>

<div class="wrap">
  <div class="stars" id="stars"></div>

  <div class="login-panel">
    <div class="brand">
      <div class="brand-icon">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4Z"/></svg>
      </div>
      <span class="brand-name">Travelok</span>
    </div>

    <div class="form-title">Selamat datang</div>
    <div class="form-sub">Masuk dan mulai perjalananmu</div>

    <form method="POST">
      <div class="field-group">
        <label class="field-label">Alamat Email</label>
        <div class="field-wrap">
          <span class="fi">📧</span>
          <input class="field-input" type="email" name="email" placeholder="nama@email.com" required />
        </div>
      </div>

      <div class="field-group">
        <label class="field-label">Kata Sandi</label>
        <div class="field-wrap">
          <span class="fi">🔒</span>
          <input class="field-input" type="password" id="pass-in" name="password" placeholder="Masukkan kata sandi" required style="padding-right:42px" />
          <button type="button" class="eye-btn" id="eye-btn" onclick="togglePass()">👁</button>
        </div>
      </div>

      <div class="options-row">
        <label class="check-label">
          <input type="checkbox" name="remember" /> Ingat saya
        </label>
        <a href="#" class="forgot">Lupa kata sandi?</a>
      </div>

      <button type="submit" class="submit-btn">Masuk ke Akun</button>
    </form>

    <div class="sep">
      <div class="sep-line"></div>
      <span class="sep-txt">atau lanjutkan dengan</span>
      <div class="sep-line"></div>
    </div>

    <div class="social-row">
      <button type="button" class="soc-btn" onclick="showToast('Masuk dengan Google')">
        <svg width="16" height="16" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Google
      </button>
      <button type="button" class="soc-btn" onclick="showToast('Masuk dengan Apple')">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
        Apple
      </button>
    </div>

    <div class="signup-row">
      Belum punya akun? <a href="#" onclick="showToast('Arahkan ke halaman daftar')">Daftar sekarang</a>
    </div>
  </div>
</div>

<?php if ($loginMessage): ?>
  <div class="toast show" id="toast"><?php echo htmlspecialchars($loginMessage); ?></div>
<?php else: ?>
  <div class="toast" id="toast"></div>
<?php endif; ?>

<script>
  // Membuat background bintang kelap-kelip secara dinamis
  var stars = document.getElementById('stars');
  for (var i = 0; i < 40; i++) {
    var s = document.createElement('div');
    s.className = 'star';
    s.style.left = Math.random() * 100 + '%';
    s.style.top = Math.random() * 100 + '%';
    s.style.animationDelay = Math.random() * 4 + 's';
    s.style.opacity = Math.random() * 0.5 + 0.2;
    var sz = Math.random() < 0.3 ? '3px' : '2px';
    s.style.width = sz; s.style.height = sz;
    stars.appendChild(s);
  }

  // Fungsi menyembunyikan/menampilkan password
  var passVis = false;
  function togglePass() {
    passVis = !passVis;
    document.getElementById('pass-in').type = passVis ? 'text' : 'password';
    document.getElementById('eye-btn').style.color = passVis ? '#38bdf8' : 'rgba(255,255,255,0.4)';
  }

  // Toast Handler untuk alert/notifikasi
  var tt;
  function showToast(msg) {
    var t = document.getElementById('toast');
    t.textContent = msg;
    // Ubah warna border jika hanya sekadar klik sosial media (bukan error bawaan PHP)
    t.style.borderLeftColor = "#38bdf8";
    t.style.borderColor = "rgba(56, 189, 248, 0.3)";
    t.classList.add('show');
    clearTimeout(tt);
    tt = setTimeout(function() { t.classList.remove('show'); }, 2800);
  }

  <?php if ($loginMessage): ?>
    setTimeout(function() {
      document.getElementById('toast').classList.remove('show');
    }, 2800);
  <?php endif; ?>
</script>

</body>
</html>