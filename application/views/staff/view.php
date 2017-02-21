<h1>Daftar Staff</h1>
<?php 
if ($this->session->flashdata('notif') != NULL) {
    echo "<div class='alert alert-info'>";
    echo $this->session->flashdata('notif');
    echo "</div>";
}
?>
<?php echo anchor('staff/new_form', 'Tambah Staff Baru') ?>
<?php echo form_open('staff/filter') ?>
    Filter berdasarkan jabatan
    <?php
    $posOpt = array('0' => 'Pilih Jabatan');
    foreach ($positions as $item) {
        $posOpt[$item->id] = $item->nama_jabatan;
    }
    echo form_dropdown('id_jabatan', $posOpt, isset($selected_position_id) ? $selected_position_id : '0');
    ?>
    <button type="submit" class="btn btn-primary">Tampilkan</button>
<?php echo form_close() ?>
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