-- ===================================================
-- FILE SQL: Pastikan ada admin di database
-- ===================================================

-- Cek admin yang ada
SELECT id_user, nama, no_hp, role 
FROM user 
WHERE role = 'admin';

-- Jika tidak ada admin, jalankan query ini:
-- UPDATE user SET role = 'admin' WHERE id_user = 13;
-- UPDATE user SET role = 'admin' WHERE id_user = 14;

-- Atau tambah admin baru:
-- INSERT INTO user (nama, umur, no_hp, role) 
-- VALUES ('Admin', 25, '081234567890', 'admin');
