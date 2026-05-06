<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$isAdmin = isset($_SESSION['user']) && (($_SESSION['role'] ?? '') === 'admin' || $_SESSION['user'] === 'admin');

require_once 'models/Studies.php';

$obj = new Studies();
$data_studies = $obj->index();
?>

<div class="container mt-3">
    <h3>data Studies</h3>

    <!-- tombol tambah -->
    <?php if ($isAdmin): ?>
        <a href="index.php?hal=form_studies" class="btn btn-primary mb-3">Tambah</a>
    <?php endif; ?>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Sekolah</th>
                <th>Level</th>
                <th>Tahun Lulus</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;
            foreach ($data_studies as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nama_level'] ?></td>
                    <td><?= $row['tahun_lulus'] ?></td>

                    <td>
                        <?php if (!empty($row['foto_sekolah'])): ?>
                            <img src="images/<?= $row['foto_sekolah'] ?>" width="60">
                        <?php endif; ?>
                    </td>

                    <td>
                        <!-- 🔍 LIHAT -->
                        <a href="detail_studies.php?id=<?= $row['id'] ?>"
                            class="btn btn-info btn-sm">
                            👁
                        </a>

                        <?php if ($isAdmin): ?>
                            <a href="index.php?hal=form_studies&id=<?= $row['id'] ?>"
                                class="btn btn-warning btn-sm">
                                ✏️
                            </a>

                            <!--  HAPUS -->
                            <a href="controller/proses_studies.php?hapus=<?= $row['id'] ?>"
                                onclick="return confirm('Yakin hapus?')"
                                class="btn btn-danger btn-sm">
                                🗑
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>