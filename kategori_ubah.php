<?php
// Assuming you have established a database connection using $koneksi

// Handle form submission
if (isset($_POST['submit'])) {
    $kategori = $_POST['kategori'];
    $id = $_GET['id'];

    $query = "UPDATE kategori SET kategori='$kategori' WHERE id_kategori = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo '<script>alert("Berhasil"); location.href="?page=kategori"; </script>';

        exit();
    } else {
        echo '<script>alert("Gagal");</script>';
    }
}

// Fetch existing category data
$id = $_GET['id'];
$query = "SELECT * FROM kategori WHERE id_kategori = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori Buku</title>
    </head>
<body>

    <h1 class="mt-4">Tambah Kategori Buku</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="post">
                        <div class="row mb-3">
                            <div class="col-md-2">Nama Kategori</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="<?php echo $data['kategori']; ?>" name="kategori">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                                <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>