<h3>Profil Saya</h3>
<?php if ($data): ?>
<table class="table table-bordered mt-3">
    <tr><th>NIM</th><td><?= htmlspecialchars($data['nim']) ?></td></tr>
    <tr><th>Nama</th><td><?= htmlspecialchars($data['nama']) ?></td></tr>
    <tr><th>Jenis Kelamin</th><td><?= htmlspecialchars($data['gender']) ?></td></tr>
    <tr><th>Kelas</th><td><?= htmlspecialchars($data['kelas']) ?></td></tr>
    <tr><th>Program Studi</th><td><?= htmlspecialchars($data['prodi']) ?></td></tr>
    <tr><th>Nomor Telephone</th><td><?= htmlspecialchars($data['notelp']) ?></td></tr>
    <tr><th>Email</th><td><?= htmlspecialchars($data['email']) ?></td></tr>
    <tr><th>Alamat</th><td><?= htmlspecialchars($data['alamat']) ?></td></tr>
</table>
<?php else: ?>
<div class="alert alert-warning">Data tidak ditemukan.</div>
<?php endif; ?>
<a href="pages/cetak.php" target="_blank" class="btn btn-success mt-3">
    <i class="fas fa-print"></i> Cetak Kartu Anggota
</a>