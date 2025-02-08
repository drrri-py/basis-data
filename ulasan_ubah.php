<?php
if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $id_buku = $_POST['id_buku'];
    $id_user = $_SESSION['user']['id_user'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    // Validasi input
    if (empty($id_buku) || empty($id_user) || empty($ulasan) || empty($rating)) {
        echo '<script>alert("Semua field harus diisi!");</script>';
    } else {
        // Prepared statement
        $stmt = $koneksi->prepare("UPDATE ulasan SET id_buku=?, id_user=?, ulasan=?, rating=? WHERE id_ulasan=?");
        if ($stmt === false) {
            die("Error preparing statement: " . $koneksi->error);
        }
        $stmt->bind_param("iissi", $id_buku, $id_user, $ulasan, $rating, $id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo '<script>alert("Berhasil"); location.href="?page=ulasan";</script>';
            } else {
                echo '<script>alert("Tidak ada data yang diupdate (mungkin ID salah)");</script>';
            }
        } else {
            echo '<script>alert("Gagal: ' . $stmt->error . '");</script>';
        }
        $stmt->close();
    }
}

$id = $_GET['id'];
$query = "SELECT * FROM ulasan WHERE id_ulasan = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<h1 class="mt-4">Ulasan Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <div class="row mb-3">
                        <label for="ulasan" class="col-md-2 col-form-label">Buku</label>
                        <div class="col-md-8">
                            <select name="id_buku" class="form-control">
                                <?php
                                $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($buku = mysqli_fetch_array($buk)) {
                                    ?>
                                    <option <?php if ($data['id_buku'] == $buku['id_buku']) echo 'selected'; ?> value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Ulasan</label>
                        <div class="col-md-8">
                            <textarea name="ulasan" rows="5" class="form-control"><?php echo $data['ulasan']; ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Rating</label>
                        <div class="col-md-8">
                            <select name="rating" class="form-control">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    ?>
                                    <option <?php if ($data['rating'] == $i) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                            <a href="?page=ulasan" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>