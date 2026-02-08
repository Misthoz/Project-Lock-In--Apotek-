<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCYDAP - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #e8e8e8;
            font-family: 'Georgia', serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .login-card {
            background: white;
            display: flex;
            min-height: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .left-panel {
            background-color: #2d6e5d;
            color: white;
            padding: 40px 50px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .logo-section {
            display: flex;
            align-items: flex-start;
            margin-bottom: 80px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .logo-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .brand-name {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
            font-family: 'Georgia', serif;
        }

        .brand-tagline {
            font-size: 13px;
            margin: 0;
            opacity: 0.9;
            font-family: 'Georgia', serif;
        }

        .welcome-title {
            font-size: 42px;
            font-weight: 400;
            margin-bottom: 8px;
            line-height: 1.2;
            font-family: 'Georgia', serif;
        }

        .welcome-subtitle {
            font-size: 15px;
            margin-bottom: 80px;
            font-family: 'Georgia', serif;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            font-size: 15px;
            font-family: 'Georgia', serif;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background: rgba(134, 239, 172, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .feature-icon i {
            color: #86efac;
            font-size: 14px;
            font-weight: 700;
        }

        .right-panel {
            background: #f5f5f5;
            padding: 40px 50px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-title {
            font-size: 36px;
            font-weight: 400;
            color: #000;
            margin-bottom: 5px;
            font-family: 'Georgia', serif;
        }

        .login-subtitle {
            color: #666;
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        .form-label {
            font-weight: 400;
            color: #000;
            margin-bottom: 8px;
            font-size: 15px;
            font-family: 'Georgia', serif;
        }

        .form-control {
            padding: 12px 15px;
            border: none;
            background: #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        .form-control:focus {
            border: none;
            background: #d9d9d9;
            box-shadow: none;
            outline: none;
        }

        .form-check {
            margin-bottom: 0;
        }

        .form-check-input {
            border: 1px solid #666;
            background: white;
        }

        .form-check-input:checked {
            background-color: #2d6e5d;
            border-color: #2d6e5d;
        }

        .form-check-label {
            font-size: 14px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .forgot-password {
            color: #86c5b3;
            text-decoration: none;
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        .forgot-password:hover {
            text-decoration: underline;
            color: #86c5b3;
        }

        .btn-login {
            background: #2d6e5d;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-weight: 400;   
            font-size: 15px;
            width: 100%;
            margin-top: 20px;
            margin-bottom: 25px;
            font-family: 'Georgia', serif;
        }

        .btn-login:hover {
            background: #235548;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #999;
        }

        .divider span {
            padding: 0 15px;
            color: #666;
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        .signup-text {
            text-align: center;
            color: #666;
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        .signup-link {
            color: #000;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 991px) {
            .login-card {
                flex-direction: column;
            }

            .left-panel, .right-panel {
                padding: 30px;
            }

            .welcome-title {
                font-size: 32px;
            }

            .login-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Left Panel -->
            <div class="left-panel">
                <div class="logo-section">
                    <div class="logo-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="brand-name">MARCYDAP</h1>
                        <p class="brand-tagline">Apotek Terpercaya</p>
                    </div>
                </div>

                <h2 class="welcome-title">Selamat Datang Kembali</h2>
                <p class="welcome-subtitle">Marcydap : Solusi Cerdas, Hidup Sehat</p>

                <ul class="feature-list">
                    <li class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span>Konsultasi dengan apoteker profesional</span>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span>Pesan obat dengan resep digital</span>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span>Riwayat pembelian tersimpan aman</span>
                    </li>
                </ul>
            </div>

            <!-- Right Panel -->
            <div class="right-panel">
                <div class="login-header">
                    <h3 class="login-title">Masuk</h3>
                    <p class="login-subtitle">Masukkan kredensial anda untuk melanjutkan</p>
                </div>

                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Email atau Username</label>
                        <input type="text" class="form-control" id="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">

                        </div>
                    </div>

                    <button type="submit" class="btn btn-login">Masuk ke Akun</button>

                    <div class="divider">
                        <span>Atau</span>
                    </div>

                    <div class="signup-text">
                        Belum punya akun?
                        <a href="daftar.php" class="signup-link">Daftar sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>