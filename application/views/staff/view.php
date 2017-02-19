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
        <tr>
            <td>1274659839393</td>
            <td>H.Suudi Spd</td>
            <td>Guru</td>
            <td>S1</td>
            <td>
                <?php echo anchor('staff/edit_student/#', 'Edit') ?> | 
                <?php echo anchor('staff/delete/#', 'Delete', array('onclick' =>  
                "return confirm('Anda yakin akan menghapus ?');")) ?>
            </td>
        </tr>
        <tr>
            <td>1274659839393</td>
            <td>H.Suudi Spd</td>
            <td>Guru</td>
            <td>S1 Universitas Indonesia</td>
            <td>
                <?php echo anchor('staff/edit_student/#', 'Edit') ?> | 
                <?php echo anchor('staff/delete/#', 'Delete', array('onclick' =>  
                "return confirm('Anda yakin akan menghapus ?');")) ?>
            </td>
        </tr>

    </tbody>
</table>