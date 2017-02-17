<h1>Daftar Siswa</h1>
<?php echo anchor('student/new_form', 'Tambah Siswa Baru') ?>
<table class="table">
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama </th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $siswa) : ?>
        <tr>
            <td><?php echo $siswa->nomor_induk ?> </td>
            <td><?php echo $siswa->nama_lengkap ?></td>
            <td><?php echo $siswa->alamat ?></td>
            <td><?php echo $siswa->jenis_kelamin ? 'Laki-laki' : 'Perempuan' ?></td>
            <td>
                <?php echo anchor('student/edit_student/'. $siswa->id, 'Edit') ?> | 
                <?php echo anchor('student/delete/'. $siswa->id, 'Delete') ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>