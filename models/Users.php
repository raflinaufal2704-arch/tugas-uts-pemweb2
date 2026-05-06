<?php
class Users
{
    // member1: variabel koneksi
    private PDO $koneksi;

    // member2: konstruktor
    public function __construct()
    {
        require_once __DIR__ . '/../koneksi.php';
        global $dbh;
        $this->koneksi = $dbh;
    }

    // 🔐 fungsi login
    public function cekLogin(array $data)
    {
        $sql = "SELECT * FROM users 
                WHERE username = ? AND password = MD5(?)";

        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
        $rs = $ps->fetch(PDO::FETCH_ASSOC);
        return $rs;
    }

    // 🔍 ambil data user berdasarkan id
    public function getUser(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";

        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        $rs = $ps->fetch(PDO::FETCH_ASSOC);
        return $rs;
    }

    // ➕ tambah user
    public function simpan(array $data)
    {
        $sql = "INSERT INTO users (username, password) VALUES (?, MD5(?))";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }
}
