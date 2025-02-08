<?php
session_start();
$koneksi = mysqli_connect(hostname: '127.0.0.1',username: 'root',password: '',database: 'dbperpus') or die (mysqli_connect_error());
