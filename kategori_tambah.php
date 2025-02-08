<?php
if(isset($_POST['submit'])) {
    $kategori = $_POST['kategori'];

    // Prepared statement
    $stmt = $koneksi->prepare("INSERT INTO kategori (kategori) VALUES (?)");
    $stmt->bind_param("s", $kategori); 
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Berhasil"); location.href="?page=kategori";</script>'; 
    } else {
        echo '<script>alert("Gagal");</script>';
    }
}
?>

<h1 class="mt-4">Tambah Kategori Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <div class="row mb-3">
                        <label for="kategori" class="col-md-2 col-form-label">Nama Kategori</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="kategori">
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