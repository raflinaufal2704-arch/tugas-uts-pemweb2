<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$isAdmin = isset($_SESSION['user']) && (($_SESSION['role'] ?? '') === 'admin' || $_SESSION['user'] === 'admin');
if (!$isAdmin) {
    echo '<div class="container mt-3"><div class="alert alert-danger">Akses ditolak. Hanya admin yang dapat melakukan pengeditan.</div></div>';
    return;
}

require_once 'models/Studies.php';
require_once 'models/Level.php';

$obj_level = new Level();
$rs = $obj_level->index();

$id = $_GET['id'] ?? null;
$obj = new Studies();

$row = $id ? $obj->getStudies($id) : [];

function val(array $row, string $key)
{
    return $row[$key] ?? '';
}
?>

<div class="container mt-3">
    <div class="card p-4 shadow-sm">

        <h3 class="mb-4">Form Studies</h3>

        <form method="POST" action="controller/proses_studies.php" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="foto_lama" value="<?= val($row, 'foto_sekolah') ?>">

            <!-- 1. NAMA -->
            <div class="form-floating mb-3">
                <input type="text" name="nama" class="form-control"
                    value="<?= val($row, 'nama') ?>"
                    placeholder="Nama Sekolah" required>
                <label>Nama Sekolah</label>
            </div>

            <!-- 2. LEVEL -->
            <div class="form-floating mb-3">
                <select name="idlevel" class="form-select" required>
                    <option value="">-- Pilih Level --</option>
                    <?php foreach ($rs as $lvl):
                        $selected = (val($row, 'idlevel') == $lvl['id']) ? 'selected' : '';
                    ?>
                        <option value="<?= $lvl['id'] ?>" <?= $selected ?>>
                            <?= $lvl['nama'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Level Pendidikan</label>
            </div>

            <!-- 3. KETERANGAN -->
            <div class="form-floating mb-3">
                <input type="text" name="keterangan" class="form-control"
                    value="<?= val($row, 'keterangan') ?>"
                    placeholder="Keterangan">
                <label>Keterangan</label>
            </div>

            <!-- 4. TAHUN -->
            <div class="form-floating mb-3">
                <input type="number" name="tahun_lulus" class="form-control"
                    value="<?= val($row, 'tahun_lulus') ?>"
                    placeholder="Tahun Lulus" required>
                <label>Tahun Lulus</label>
            </div>

            <!-- 5. FOTO -->
            <div class="form-floating mb-3">
                <input type="text" name="foto_sekolah" class="form-control"
                    value="<?= val($row, 'foto_sekolah') ?>"
                    placeholder="Foto Sekolah">
                <label>Foto Sekolah</label>
            </div>

            <!-- BUTTON -->
            <div class="text-center mt-3">
                <?php if (empty($id)) { ?>
                    <button class="btn btn-primary" name="proses" value="simpan">
                        Simpan
                    </button>
                <?php } else { ?>
                    <button class="btn btn-success" name="proses" value="ubah">
                        Ubah
                    </button>
                <?php } ?>

                <a href="index.php?hal=mystudies" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>