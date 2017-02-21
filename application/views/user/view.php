<h1>Daftar Pengguna</h1>
<?php 
if ($this->session->flashdata('notif') != NULL) {
    echo "<div class='alert alert-info'>";
    echo $this->session->flashdata('notif');
    echo "</div>";
}
?>
<?php echo anchor('user/new_form', 'Tambah Pengguna Baru') ?>
<table class="table">
    <thead>
        <tr>
            <th>username</th>
            <th>Nama Lenkap</th>            
            <th>Peran</th>
            <th>Status</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) : ?>
        <tr>
            <td><?php echo $user->username ?></td>
            <td><?php echo $user->nama ?></td>
            <td><?php echo $user->peran ?></td>
            <td><?php echo $user->status == true ? 'AKTIF' : 'NON AKTIF' ?></td>
            <td>
                <?php echo anchor('user/edit/'. $user->id_pengguna , 'Edit') ?>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>