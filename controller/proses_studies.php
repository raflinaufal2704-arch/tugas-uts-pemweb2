<?php
require_once '../koneksi.php';
require_once '../models/Studies.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user']) || (($_SESSION['role'] ?? '') !== 'admin' && $_SESSION['user'] !== 'admin')) {
    header("Location: ../index.php?hal=mystudies&error=forbidden");
    exit;
}

$obj = new Studies();

// HAPUS
if (isset($_GET['hapus'])) {
    $obj->hapus($_GET['hapus']);
    header("Location: ../index.php?hal=mystudies");
    exit;
}

// SIMPAN & UPDATE
if (isset($_POST['proses'])) {

    $foto = $_POST['foto_sekolah']; // sementara text dulu

    $data = [
        $_POST['nama'],
        $_POST['idlevel'],
        $_POST['keterangan'],
        $_POST['tahun_lulus'],
        $foto
    ];

    if ($_POST['proses'] == 'simpan') {
        $obj->simpan($data);
    } else {
        $data[] = $_POST['id'];
        $obj->ubah($data);
    }

    header("Location: ../index.php?hal=mystudies");
    exit;
}
