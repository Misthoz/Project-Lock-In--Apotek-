<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCYDAP - Buat Akun Baru</title>
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
            min-height: 100vh;
            padding: 20px;
        }

        .register-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header-section {
            background-color: #2d5a4a;
            color: white;
            padding: 35px 40px;
            position: relative;
        }

        .header-title {
            font-size: 42px;
            font-weight: 400;
            margin-bottom: 8px;
            font-family: 'Georgia', serif;
        }

        .header-subtitle {
            font-size: 15px;
            margin: 0;
            opacity: 0.95;
            font-family: 'Georgia', serif;
        }

        .close-button {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #5eb89a;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .close-button:hover {
            background-color: #4fa385;
        }

        .close-button::before,
        .close-button::after {
            content: '';
            position: absolute;
            width: 30px;
            height: 3px;
            background-color: #2d5a4a;
        }

        .close-button::before {
            transform: rotate(90deg);
        }

        .form-section {
            padding: 40px;
            background-color: #f5f5f5;
        }

        .form-label {
            font-size: 14px;
            color: #000;
            margin-bottom: 8px;
            font-weight: 400;
            font-family: 'Georgia', serif;
        }

        .form-label .required {
            color: #dc3545;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #000;
            font-size: 18px;
            z-index: 10;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: none;
            background-color: #d5d5d5;
            font-size: 14px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        .form-control-custom:focus {
            outline: none;
            background-color: #d5d5d5;
        }

        .form-control-custom.focused {
            border: 2px solid #5eb89a;
            background-color: white;
        }

        .row-custom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .dropdown-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            background-color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .dropdown-icon::after {
            content: '';
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid white;
        }

        select.form-control-custom {
            appearance: none;
            cursor: pointer;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background-color: #5eb89a;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: 400;
            margin-top: 10px;
            margin-bottom: 20px;
            cursor: pointer;
            font-family: 'Georgia', serif;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background-color: #4fa385;
        }

        .login-link-section {
            text-align: center;
            font-size: 14px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        .login-link {
            color: #000;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .header-section {
                padding: 25px 30px;
            }

            .header-title {
                font-size: 32px;
            }

            .close-button {
                width: 50px;
                height: 50px;
                top: 20px;
                right: 20px;
            }

            .form-section {
                padding: 30px 20px;
            }

            .row-custom {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="header-title">Buat Akun Baru</h1>
            <p class="header-subtitle">Bergabunglah dengan ribuan pengguna yang mempercayai Marcydap</p>
            <button class="close-button" onclick="window.location.href='login.html'"></button>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <form>
                <!-- Nama Depan & Nama Belakang -->
                <div class="row-custom">
                    <div>
                        <label class="form-label">Nama Depan <span class="required">*</span></label>
                        <div class="input-group-custom">
                            <i class="bi bi-person-fill input-icon"></i>
                            <input type="text" class="form-control-custom" placeholder="Nama depan">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Nama Belakang <span class="required">*</span></label>
                        <div class="input-group-custom">
                            <i class="bi bi-person-fill input-icon"></i>
                            <input type="text" class="form-control-custom focused" placeholder="Nama depan">
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="form-label">Email <span class="required">*</span></label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input type="email" class="form-control-custom" placeholder="nama@email.com">
                    </div>
                </div>

                <!-- No Telepon & Tanggal Lahir -->
                <div class="row-custom">
                    <div>
                        <label class="form-label">No Telepon <span class="required">*</span></label>
                        <div class="input-group-custom">
                            <i class="bi bi-phone-fill input-icon"></i>
                            <input type="tel" class="form-control-custom" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Lahir <span class="required">*</span></label>
                        <div class="input-group-custom">
                            <i class="bi bi-calendar-fill input-icon"></i>
                            <input type="text" class="form-control-custom" placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                    <div class="input-group-custom">
                        <i class="bi bi-gender-ambiguous input-icon"></i>
                        <select class="form-control-custom">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        <div class="dropdown-icon"></div>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="form-label">Password <span class="required">*</span></label>
                    <div class="input-group-custom">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" class="form-control-custom" placeholder="Minimal 8 karakter">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-register">Daftar Sekarang</button>

                <!-- Login Link -->
                <div class="login-link-section">
                    Sudah punya akun?
                    <a href="login.php" class="login-link">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add focus effect to inputs
        document.querySelectorAll('.form-control-custom').forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>