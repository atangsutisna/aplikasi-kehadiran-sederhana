<h1>Daftar Staff</h1>
<?php 
if ($this->session->flashdata('notif') != NULL) {
    echo "<div class='alert alert-info'>";
    echo $this->session->flashdata('notif');
    echo "</div>";
}
?>
<?php echo anchor('staff/new_form', 'Tambah Staff Baru') ?>
<form>
    Filter berdasarkan jabatan
    <?php
    $positions = array(
        '0' => 'Pilih Jabatan',
        'kepsek' => 'Kepala Sekolah',
        'wakepsek' => 'Wakil Kepala Sekolah',
        'guru' => 'Guru',
      );
    echo form_dropdown('id_jabatan', $positions, '0');
    ?>
    <button type="submit" class="btn btn-primary">Tampilkan</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama </th>
            <th>Jabatan</th>
            <th>Pendidikan</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($staffs as $staff) : ?>
        <tr>
            <td><?php echo $staff->nip ?></td>
            <td><?php echo $staff->nama ?></td>
            <td><?php echo $staff->nama_jabatan ?></td>
            <td><?php echo $staff->pendidikan_terakhir ?></td>
            <td>
                <?php echo anchor('staff/edit/'. $staff->id, 'Edit') ?> | 
                <?php echo anchor('staff/delete/'. $staff->id, 'Delete', array('onclick' =>  
                "return confirm('Anda yakin akan menghapus ?');")) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>