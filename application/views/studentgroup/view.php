<h1>Daftar Kelas</h1>
<?php 
if ($this->session->flashdata('notif') != NULL) {
    echo "<div class='alert alert-info'>";
    echo $this->session->flashdata('notif');
    echo "</div>";
}
?>
<?php echo anchor('student_group/new_form', 'Tambah Kelas Baru') ?>
<table class="table">
    <tdead>
        <tr>
            <th>Tahun Ajaran</th>
            <th>Nama Kelas</th>            
            <th>Wali Kelas</th>
            <th>Total Siswa</th>            
            <th>#</th>
        </tr>
    </tdead>
    <tbody>
        <?php foreach ($groups as $kelas) : ?>
        <tr>
            <td><?php echo $kelas->tahun_ajaran ?></td>
            <td><?php echo $kelas->nama_kelas ?></td>
            <td>-</td>            
            <td><?php echo anchor('student_group/new_member', 'Tambah Anggota') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>