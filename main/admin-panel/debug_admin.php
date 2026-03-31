<?php
// ===================================================
// FILE DEBUG: Cek data admin di database
// ===================================================

include '../../config/db.php';

echo "<h2>🔍 DEBUG: Data Admin di Database</h2>";
echo "<hr>";

// Query semua user
$query = "SELECT id_user, nama, umur, no_hp, role FROM user ORDER BY role DESC, id_user ASC";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($db));
}

echo "<h3>📋 Semua User di Database:</h3>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
echo "<tr style='background: #f0f0f0;'>";
echo "<th>ID</th><th>Nama</th><th>Umur</th><th>No HP</th><th>Role</th>";
echo "</tr>";

$total_admin = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $bg_color = $row['role'] == 'admin' ? '#d1fae5' : '#ffffff';
    echo "<tr style='background: $bg_color;'>";
    echo "<td>" . $row['id_user'] . "</td>";
    echo "<td>" . $row['nama'] . "</td>";
    echo "<td>" . $row['umur'] . "</td>";
    echo "<td><strong>" . $row['no_hp'] . "</strong></td>";
    echo "<td><strong>" . strtoupper($row['role']) . "</strong></td>";
    echo "</tr>";
    
    if ($row['role'] == 'admin') {
        $total_admin++;
    }
}

echo "</table>";
echo "<br>";
echo "<p><strong>Total Admin: $total_admin</strong></p>";

echo "<hr>";
echo "<h3>✅ Admin yang bisa login:</h3>";
$query_admin = "SELECT nama, no_hp FROM user WHERE role = 'admin'";
$result_admin = mysqli_query($db, $query_admin);

if (mysqli_num_rows($result_admin) > 0) {
    echo "<ul>";
    while ($admin = mysqli_fetch_assoc($result_admin)) {
        echo "<li><strong>No HP:</strong> " . $admin['no_hp'] . " | <strong>Nama:</strong> " . $admin['nama'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ TIDAK ADA ADMIN DI DATABASE!</p>";
    echo "<p>Jalankan query ini di phpMyAdmin:</p>";
    echo "<pre>UPDATE user SET role = 'admin' WHERE no_hp = '081348962272';</pre>";
}

echo "<hr>";
echo "<p><a href='login.php'>← Kembali ke Login</a></p>";
?>

<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        background: #f5f5f5;
    }
    table {
        background: white;
        width: 100%;
        max-width: 800px;
    }
    h2, h3 {
        color: #1a472a;
    }
</style>
