<?php
class Level
{
    private PDO $koneksi;

    public function __construct()
    {
        require_once __DIR__ . '/../koneksi.php';
        global $dbh;
        $this->koneksi = $dbh;
    }

    public function index()
    {
        $sql = "SELECT * FROM level";
        $rs = $this->koneksi->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLevel(int $id)
    {
        $sql = "SELECT * FROM level WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetch(PDO::FETCH_ASSOC);
    }

    public function simpan(array $data)
    {
        $sql = "INSERT INTO level (nama) VALUES (?)";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }

    public function ubah(array $data)
    {
        $sql = "UPDATE level SET nama=? WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }

    public function hapus(int $id)
    {
        $sql = "DELETE FROM level WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
    }

    public function cekDipakai(int $id)
    {
        $sql = "SELECT COUNT(*) FROM studies WHERE idlevel=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetchColumn();
    }
}
