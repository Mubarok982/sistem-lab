<?php foreach($ujian as $u): ?>
<tr>
    <td><?= $u->nama_mahasiswa ?></td>
    <td><?= $u->tema ?></td>
    <td><?= date('d-m-Y', strtotime($u->tanggal)) ?></td>
    <td>
        <a href="<?= base_url('admin/detail_ujian/view/'.$u->id) ?>">Detail</a>
    </td>
</tr>
<?php endforeach; ?>
