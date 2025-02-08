<?php
if(isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_user = $_SESSION['user']['id_user'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    // Validasi input
    if (empty($id_buku) || empty($id_user) || empty($ulasan) || empty($rating)) {
        echo '<script>alert("Semua field harus diisi!");</script>';
    } else {
        // Prepared statement
        $stmt = $koneksi->prepare("INSERT INTO ulasan (id_buku, id_user, ulasan, rating) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $koneksi->error);
        }
        $stmt->bind_param("iiss", $id_buku, $id_user, $ulasan, $rating);

        if ($stmt->execute()) {
            echo '<script>alert("Berhasil"); location.href="?page=ulasan";</script>';
        } else {
            echo '<script>alert("Gagal: ' . $stmt->error . '");</script>'; 
        }

        $stmt->close();
    }
}
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
                                    while($buku = mysqli_fetch_array($buk)) {
                                        ?>
                                        <option value="<?php echo $buku['id_buku'];?>"><?php echo $buku['judul'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Ulasan</label>
                        <div class="col-md-8">
                            <textarea name="ulasan" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Rating</label>
                        <div class="col-md-8">
                            <select name="rating" class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button> 
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=ulasan" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>