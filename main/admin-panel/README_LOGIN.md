# 🔐 SISTEM LOGIN ADMIN PANEL

## 📋 DAFTAR FILE

1. **login.php** - Halaman login admin
2. **login_process.php** - Proses autentikasi
3. **logout.php** - Logout & hapus session
4. **admin-panel.php** - Dashboard admin (sudah ada proteksi login)
5. **process_order.php** - Proses approve/cancel (sudah ada proteksi login)

---

## 🚀 CARA KERJA

### 1. **Login**
```
1. Admin buka: login.php
2. Masukkan nomor HP yang terdaftar sebagai admin
3. Sistem cek di database:
   - Apakah no HP ada?
   - Apakah role = 'admin'?
4. Jika benar → Login berhasil → Redirect ke admin-panel.php
5. Jika salah → Tampilkan pesan error
```

### 2. **Session**
Setelah login berhasil, data disimpan di session:
- `$_SESSION['admin_logged_in']` = true
- `$_SESSION['admin_id']` = ID user
- `$_SESSION['admin_nama']` = Nama admin
- `$_SESSION['admin_no_hp']` = No HP admin

### 3. **Proteksi Halaman**
Setiap halaman admin di awal ada kode:
```php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
```

### 4. **Logout**
Klik tombol Logout → Hapus semua session → Redirect ke login.php

---

## 👤 ADMIN DI DATABASE

Berdasarkan database `db_apotek`, admin yang bisa login:

| Nama | No HP | Role |
|------|-------|------|
| Finn | 081348962272 | admin |
| Finn Seville | 081348962272 | admin |

---

## 🔧 CARA MENAMBAH ADMIN BARU

Jalankan query SQL di phpMyAdmin:

```sql
INSERT INTO user (nama, umur, no_hp, role) 
VALUES ('Nama Admin', 25, '081234567890', 'admin');
```

---

## 📝 ALUR LENGKAP

```
┌─────────────────┐
│   login.php     │ ← User buka halaman ini
└────────┬────────┘
         │ Isi no HP → Submit
         ▼
┌─────────────────────┐
│ login_process.php   │
│                     │
│ 1. Cek no HP exist? │
│ 2. Cek role=admin?  │
│ 3. Simpan session   │
└────────┬────────────┘
         │
         ├─ Berhasil ──────────────┐
         │                         ▼
         │              ┌──────────────────┐
         │              │ admin-panel.php  │ ← Dashboard
         │              └──────────────────┘
         │
         └─ Gagal ─────────────────┐
                                   ▼
                        ┌──────────────────┐
                        │ login.php?error  │ ← Tampil error
                        └──────────────────┘
```

---

## ⚡ TESTING

1. Buka: `http://localhost/Project-Lock-In--Medis-/main/admin-panel/login.php`
2. Masukkan no HP: `081348962272`
3. Klik "Login ke Admin Panel"
4. Jika berhasil, akan masuk ke dashboard
5. Untuk logout, klik tombol "Logout" di sidebar

---

## 🎯 FITUR

✅ Login menggunakan No HP
✅ Validasi role admin
✅ Session management
✅ Protected pages
✅ Logout functionality
✅ Error messages
✅ Info admin di sidebar & top bar
✅ Simple & mudah dipahami

---

**CATATAN:** Sistem ini menggunakan autentikasi sederhana tanpa password. 
Untuk production, sebaiknya tambahkan field password dan gunakan password_hash().
