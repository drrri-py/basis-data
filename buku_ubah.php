<?php
if (isset($_POST['submit'])) {
    $id = $_GET['id']; // Ambil ID buku dari URL
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
        $stmt = $koneksi->prepare("UPDATE buku SET id_kategori=?, judul=?, penulis=?, penerbit=?, tahun_terbit=?, deskripsi=? WHERE id_buku=?");
        if ($stmt === false) {
            die("Error preparing statement: " . $koneksi->error); 
        }
        $stmt->bind_param("isssssi", $kategori, $judul, $penulis, $penerbit, $tahun_terbit, $deskripsi, $id); // Bind parameter
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo '<script>alert("Berhasil"); location.href="?page=buku";</script>';
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
$query = "SELECT * FROM buku WHERE id_buku = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<h1 class="mt-4">Ubah Buku</h1>
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
                                        <option <?php if($kategori['id_kategori'] == $data['id_kategori']) echo 'selected'; ?> value="<?php echo $kategori['id_kategori'];?>"><?php echo $kategori['kategori'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-8">
                            <input type="text" value="<?php echo $data['judul']; ?>" class="form-control" name="judul">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Penulis</label>
                        <div class="col-md-8">
                            <input type="text" value="<?php echo $data['penulis']; ?>" class="form-control" name="penulis">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Penerbit</label>
                        <div class="col-md-8">
                            <input type="text" value="<?php echo $data['penerbit']; ?>" class="form-control" name="penerbit">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Tahun terbit</label>
                        <div class="col-md-8">
                            <input type="number" value="<?php echo $data['tahun_terbit']; ?>" class="form-control" name="tahun_terbit">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <textarea name="deskripsi" rows="5" class="form-control" ><?php echo $data['deskripsi']; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                            <a href="?page=buku" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>