<h1>Daftar User</h1>
<?php 
if ($this->session->flashdata('notif') != NULL) {
    echo "<div class='alert alert-info'>";
    echo $this->session->flashdata('notif');
    echo "</div>";
}
?>
<?php echo anchor('user/new_form', 'Tambah User Baru') ?>
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
        <tr>
            <td>admin</td>
            <td>Suprayatno</td>
            <td>ADMINISTRATOR</td>
            <td>aktif</td>
            <td>
                <?php echo anchor('user/edit_user/' , 'Edit') ?>  
            </td>
        </tr>
        <tr>
            <td>tinatoon</td>
            <td>TINA TOON</td>
            <td>SKRETARIS_SEKOLAH</td>
            <td>aktif</td>
            <td>
                <?php echo anchor('user/edit_user/' , 'Edit') ?>  
            </td>
        </tr>
        <tr>
            <td>albert</td>
            <td>Albert Einsten</td>
            <td>GURU</td>
            <td>aktif</td>
            <td>
                <?php echo anchor('user/edit_user/' , 'Edit') ?>  
            </td>
        </tr>
        
        
    </tbody>
</table>