<?php
if(isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_user = $_SESSION['user']['id_user'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $status_peminjaman = $_POST['status_peminjaman'];

    // Validasi input
    if (empty($id_buku) || empty($id_user) || empty($tanggal_peminjaman) || empty($tanggal_peminjaman) || empty($status_peminjaman)) {
        echo '<script>alert("Semua field harus diisi!");</script>';
    } else {
        // Prepared statement
        $stmt = $koneksi->prepare("INSERT INTO peminjaman (id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $koneksi->error);
        }
        $stmt->bind_param("iisss", $id_buku, $id_user, $tanggal_peminjaman, $tanggal_pengembalian, $status_peminjaman);

        if ($stmt->execute()) { 
            echo '<script>alert("Berhasil"); location.href="?page=peminjaman";</script>';
        } else {
            echo '<script>alert("Gagal: ' . $stmt->error . '");</script>';
        }
        $stmt->close();
    }
}
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
                                        <option value="<?php echo $buku['id_buku'];?>"><?php echo $buku['judul'];?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Tanggal Peminjaman</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="tanggal_peminjaman">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Tanggal pengembalian</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="tanggal_pengembalian">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">status Peminjaman</label>
                        <div class="col-md-8">
                            <select name="status_peminjaman" class="form-control">
                                <option value="dipinjam">Dipinjam</option>
                                <option value="dikembalikan">Dikembalikan</option>
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