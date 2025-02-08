<h1 class="mt-4">Laporan Peminjaman Buku</h1>
<div class="row">
    <div class="col-md-12">
        <a href="?page=peminjaman_tambah" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Peminjaman</a>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>status Peminjaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku WHERE peminjaman.id_user=" . $_SESSION['user']['id_user']);
                while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['tanggal_peminjaman']; ?></td>
                        <td><?php echo $data['tanggal_pengembalian']; ?></td>
                        <td><?php echo $data['status_peminjaman']; ?></td>
                        <td>
                            <?php
                            if($data['status_peminjaman'] !='dikembalikan') {
                            ?>
                            <a href="?page=peminjaman_ubah&id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info">Ubah</a> 
                            <a onclick="return confirm('Hapus?');"href="?page=peminjaman_hapus&id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-danger">Hapus</a>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>