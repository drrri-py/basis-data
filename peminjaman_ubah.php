<?php
$id = $_GET['id'];
if(isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_user = $_SESSION['user']['id_user'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $status_peminjaman = $_POST['status_peminjaman'];

    // Validasi input)
    if (empty($id_buku) || empty($id_user) || empty($tanggal_peminjaman) || empty($tanggal_pengembalian) || empty($status_peminjaman)) {
        echo '<script>alert("Semua field harus diisi!");</script>';
    } else {
        // Prepared statement
        $stmt = $koneksi->prepare("UPDATE peminjaman SET id_buku=?, id_user=?, tanggal_peminjaman=?, tanggal_pengembalian=?, status_peminjaman=? WHERE id_peminjaman=?");
        if ($stmt === false) {
            die("Error preparing statement: " . $koneksi->error);
        }
        $stmt->bind_param("iisssi", $id_buku, $id_user, $tanggal_peminjaman, $tanggal_pengembalian, $status_peminjaman, $id); // Bind parameter dengan benar

        if ($stmt->execute()) {
            echo '<script>alert("Berhasil"); location.href="?page=peminjaman";</script>';
        } else {
            echo '<script>alert("Gagal: ' . $stmt->error . '");</script>';
        }
        $stmt->close();
    }
}

$id = $_GET['id'];
$query = "SELECT * FROM peminjaman WHERE id_peminjaman = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<h1 class="mt-4">Peminjaman Buku</h1>
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
                                        <option <?php if($buku['id_buku'] == $data['id_buku']) echo 'selected'; ?> value="<?php echo $buku['id_buku'];?>"><?php echo $buku['judul'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Tanggal Peminjaman</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" value="<?php echo $data['tanggal_peminjaman']; ?>" name="tanggal_peminjaman">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Tanggal pengembalian</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" value="<?php echo $data['tanggal_pengembalian']; ?>" name="tanggal_pengembalian">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">status Peminjaman</label>
                        <div class="col-md-8">
                            <select name="status_peminjaman" class="form-control">
                                <option value="dipinjam" <?php if($data['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
                                <option value="dikembalikan" <?php if($data['status_peminjaman'] == 'dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button> 
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=peminjaman" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>