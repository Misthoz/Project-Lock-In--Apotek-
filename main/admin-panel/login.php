<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Marcydap Apotek</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a472a 0%, #2d6a4f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 420px;
            padding: 50px 40px;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #2d6a4f, #52b788);
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin-bottom: 15px;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 800;
            color: #1a472a;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #52b788;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #2d6a4f, #52b788);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(45, 106, 79, 0.4);
        }

        .info-box {
            margin-top: 30px;
            padding: 20px;
            background: #f8fafb;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .info-box h4 {
            font-size: 13px;
            color: #1a472a;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .info-box p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 5px;
        }

        .info-box strong {
            color: #0f172a;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <div class="logo-icon">🌿</div>
            <h1>MARCYDAP</h1>
            <p>Admin Panel Login</p>
        </div>

        <!-- Alert Error (jika ada) -->
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-error">
                ❌ 
                <?php 
                if ($_GET['error'] == 'wrong') {
                    echo 'Nomor HP atau role salah!';
                } elseif ($_GET['error'] == 'notadmin') {
                    echo 'Anda bukan admin! Hanya admin yang bisa login.';
                } elseif ($_GET['error'] == 'empty') {
                    echo 'Nomor HP tidak boleh kosong!';
                }
                ?>
            </div>
        <?php } ?>

        <!-- Form Login -->
        <form method="POST" action="login_process.php">
            <div class="form-group">
                <label>Nomor HP Admin</label>
                <input type="text" 
                       name="no_hp" 
                       placeholder="Contoh: 081348962272" 
                       required
                       autofocus>
            </div>

            <button type="submit" class="btn-login">
                🔓 Login ke Admin Panel
            </button>
        </form>

        <!-- Info Box -->
        <div class="info-box">
            <h4>ℹ️ Info Login Admin</h4>
            <p>Login menggunakan <strong>Nomor HP</strong> yang terdaftar sebagai admin di database.</p>
            <p>Contoh admin di database:</p>
            <p><strong>• 081348962272</strong> (Finn - Admin)</p>
            <br>
            <p style="text-align: center;">
                <a href="debug_admin.php" style="color: #2d6a4f; text-decoration: none; font-weight: 600;">
                    🔍 Lihat Data Admin di Database
                </a>
            </p>
        </div>
    </div>
</body>
</html>
