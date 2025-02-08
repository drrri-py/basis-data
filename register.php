<?php
include "koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register</h3></div>
                                    <div class="card-body">
                                        <?php
                                            if (isset($_POST['register'])) {
                                                $nama = $_POST['nama'];
                                                $email = $_POST['email'];
                                                $alamat = $_POST['alamat'];
                                                $no_telepon = $_POST['no_telepon'];
                                                $username = $_POST['username'];
                                                $level = "peminjam"; // Mengisi level secara otomatis
                                                $password = md5($_POST['password']); // Menggunakan MD5 (TIDAK DISARANKAN!)
                                            
                                                // Prepared statement
                                                $stmt = $koneksi->prepare("INSERT INTO user (nama, email, alamat, no_telepon, username, password, level) 
                                                                            VALUES (?, ?, ?, ?, ?, ?, ?)");
                                                $stmt->bind_param("sssssss", $nama, $email, $alamat, $no_telepon, $username, $password, $level);
                                                $stmt->execute();
                                            
                                                if ($stmt->affected_rows > 0) {
                                                    echo '<script>alert("Register Berhasil"); location.href="login.php"</script>';
                                                } else {
                                                    echo '<script>alert("Register Gagal");</script>';
                                                }
                                            }
                                        ?>
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" required name="nama" placeholder="masukan nama lengkap" />
                                                <label >Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" required name="email" placeholder="masukan email" />
                                                <label >Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" required name="no_telepon" placeholder="masukan nomor telephon" />
                                                <label >Nomor telephon</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea name="alamat" rows="5" required class="form-control"></textarea>
                                                <label >Alamat</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" required name="username" placeholder="masukan username" />
                                                <label >username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" required name="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="sumbit" name="register" value="register">register</button>
                                                <a class="btn btn-danger" href="login.php">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
