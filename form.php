<!DOCTYPE html>
<html>
<head>
  <title>Form Data Pegawai</title>
  <style>
    .form-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 4px;
}

.form-container h2 {
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.form-group textarea {
  height: 80px;
}

.form-group input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 4px;
  cursor: pointer;
}

.form-group input[type="submit"]:hover {
  background-color: #0056b3;
}

.form-group a  {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 9px 15px;
  border-radius: 4px;
  cursor: pointer;
}
.form-group a :hover {
  background-color: #0056b3;
}
    </style>
</head>
<body class="form-container">
  <h2>Input Data Pegawai</h2>

  <?php
  // Menghubungkan ke database
  $host = '127.0.0.1';
  $dbname = 'classicmodels';
  $username = 'root';
  $password = '';

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mengambil data pegawai jika ID ada
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $pegawai = null;
    if ($id) {
      $stmt = $dbh->prepare("SELECT * FROM classicmodels.pegawai WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      $pegawai = $stmt->fetch();
    }
    ?>

    <!-- Form input/edit data pegawai -->
    <form class="form-container form-group" action="<?php echo $id ? 'update.php' : 'save.php'; ?>" method="POST">
      <?php if ($id): ?>
        <input type="hidden" name="id" value="<?php echo $pegawai['id']; ?>">
      <?php endif; ?>

      <label for="nama">Nama:</label>
      <input type="text" id="nama" name="nama" value="<?php echo $pegawai ? $pegawai['nama'] : ''; ?>" required><br><br>

      <label for="umur">Umur:</label>
      <input type="number" id="umur" name="umur" value="<?php echo $pegawai ? $pegawai['umur'] : ''; ?>" required><br><br>

      <label for="alamat">Alamat:</label>
      <textarea id="alamat" name="alamat" required><?php echo $pegawai ? $pegawai['alamat'] : ''; ?></textarea><br><br>

      <input class ="form-group" type="submit" value="<?php echo $id ? 'Update' : 'Simpan'; ?>">
      <a style="text-decoration:none" href="index.php">Cek Data</a>
    </form>

    <?php
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  ?>

</body>
</html>