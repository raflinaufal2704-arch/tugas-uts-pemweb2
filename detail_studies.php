<?php
require_once 'models/Studies.php';
require_once 'models/Level.php';

$id = $_GET['id'] ?? null;

$obj = new Studies();
$row = $obj->getStudies($id);

$obj_level = new Level();
$level = $obj_level->getLevel($row['idlevel']);

// fallback gambar
$foto = !empty($row['foto_sekolah']) ? $row['foto_sekolah'] : 'default.png';
?>

<div class="container mt-3">

    <div class="card p-4 shadow-sm">
        <div class="row align-items-center">

            <!-- GAMBAR -->
            <div class="col-md-4 text-center">
                <img src="images/<?= $foto ?>"
                    class="img-fluid rounded"
                    style="max-height:250px;">
            </div>

            <!-- DETAIL -->
            <div class="col-md-8">

                <h4 class="mb-3"><?= $row['nama'] ?></h4>

                <p><strong>Level Pendidikan:</strong> <?= $level['nama'] ?></p>
                <p><strong>Keterangan:</strong> <?= $row['keterangan'] ?></p>
                <p><strong>Tahun Lulus:</strong> <?= $row['tahun_lulus'] ?></p>

                <a href="index.php?hal=mystudies" class="btn btn-primary mt-2">
                    Kembali
                </a>

            </div>

        </div>
    </div>

</div>