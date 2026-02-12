<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCYDAP - Hubungi Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background-color: #e0e0e0;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background-color: #f5f5f5;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-logo {
            width: 40px;
            height: 40px;
            background-color: #2d6e5d;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo i {
            font-size: 24px;
            color: white;
        }

        .header-title {
            font-size: 16px;
            font-weight: 700;
            color: #000;
            font-family: 'Georgia', serif;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #2d6e5d 0%, #5eb89a 100%);
            padding: 60px 30px;
            color: white;
            text-align: center;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 400;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
        }

        .hero-description {
            font-size: 14px;
            line-height: 1.7;
            max-width: 650px;
            margin: 0 auto;
            font-family: 'Georgia', serif;
        }

        /* Contact Methods */
        .contact-methods {
            padding: 40px 30px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .methods-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .method-card {
            background-color: white;
            padding: 40px 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .method-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .method-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2d6e5d 0%, #5eb89a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .method-icon i {
            font-size: 28px;
            color: white;
        }

        /* Message Form */
        .message-form-section {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            max-width: 600px;
        }

        .form-title {
            font-size: 28px;
            font-weight: 400;
            margin-bottom: 10px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .form-subtitle {
            font-size: 13px;
            color: #666;
            margin-bottom: 30px;
            font-family: 'Georgia', serif;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: block;
            font-family: 'Georgia', serif;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: none;
            background-color: #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        .form-input:focus {
            outline: none;
            background-color: #d0d0d0;
        }

        .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: none;
            background-color: #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            font-family: 'Georgia', serif;
            min-height: 150px;
            resize: vertical;
        }

        .form-textarea:focus {
            outline: none;
            background-color: #d0d0d0;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2d6e5d 0%, #5eb89a 100%);
            color: white;
            border: none;
            padding: 14px 40px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Georgia', serif;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 110, 93, 0.3);
        }

        @media (max-width: 768px) {
            .methods-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-title {
                font-size: 32px;
            }

            .message-form-section {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .methods-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-logo">
            <i class="bi bi-plus-lg"></i>
        </div>
        <h1 class="header-title">MARCYDAP</h1>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <h2 class="hero-title">Hubungi Kami</h2>
        <p class="hero-description">
            Kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami melalui berbagai saluran yang tersedia
        </p>
    </div>

    <!-- Contact Methods & Form -->
    <div class="contact-methods">
        <!-- Contact Method Cards -->
        <div class="methods-grid">
            <!-- Phone -->
            <div class="method-card">
                <div class="method-icon">
                    <i class="bi bi-telephone-fill"></i>
                </div>
            </div>

            <!-- Email -->
            <div class="method-card">
                <div class="method-icon">
                    <i class="bi bi-envelope-fill"></i>
                </div>
            </div>

            <!-- Chat -->
            <div class="method-card">
                <div class="method-icon">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
            </div>

            <!-- Location -->
            <div class="method-card">
                <div class="method-icon">
                    <i class="bi bi-phone-fill"></i>
                </div>
            </div>
        </div>

        <!-- Message Form -->
        <div class="message-form-section">
            <h3 class="form-title">Kirim Pesan</h3>
            <p class="form-subtitle">Isi formulir di bawah ini dan kami akan merespons dalam 24 jam</p>

            <form>
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" placeholder="">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" placeholder="">
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-input" placeholder="">
                </div>

                <div class="form-group">
                    <label class="form-label">Pesan</label>
                    <textarea class="form-textarea" placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>

                <button type="submit" class="btn-submit">Kirim Pesan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>