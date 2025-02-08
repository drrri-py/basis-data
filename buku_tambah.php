<?php
if(isset($_POST['submit'])) {
    $kategori = $_POST['id_kategori'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $deskripsi = $_POST['deskripsi'];

    // Validasi input
    if (empty($kategori) || empty($judul) || empty($penulis) || empty($penerbit) || empty($tahun_terbit) || empty($deskripsi)) {
        echo '<script>alert("Semua field harus diisi!");</script>';
    } else {
        // Prepared statement
        $stmt = $koneksi->prepare("INSERT INTO buku (id_kategori, judul, penulis, penerbit, tahun_terbit, deskripsi) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $koneksi->error);
        }
        $stmt->bind_param("isssss", $kategori, $judul, $penulis, $penerbit, $tahun_terbit, $deskripsi); // Bind parameter
        if ($stmt->execute()) {
            echo '<script>alert("Berhasil"); location.href="?page=buku";</script>';
        } else {
            echo '<script>alert("Gagal: ' . $stmt->error . '");</script>';
        }
        $stmt->close();
    }
}
?>

<h1 class="mt-4">Tambah Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select name="id_kategori" class="form-control">
                                <?php
                                    $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                                    while($kategori = mysqli_fetch_array($kat)) {
                                        ?>
                                        <option value="<?php echo $kategori['id_kategori'];?>"><?php echo $kategori['kategori'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="judul">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Penulis</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="penulis">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Penerbit</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="penerbit">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Tahun terbit</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="tahun_terbit">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <textarea name="deskripsi" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button> 
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>