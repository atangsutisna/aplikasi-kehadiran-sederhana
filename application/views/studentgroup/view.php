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
        <tr>
            <td>2016/2017</td>
            <td>I A</td>
            <td>Leonardo Da Vinci</td>            
            <td><?php echo anchor('student_group/new_member', 'Tambah Anggota') ?></td>
        </tr>
        <tr>
            <td>2016/2017</td>
            <td>I B</td>            
            <td>Plato</td>    
            <td><?php echo anchor('student_group/new_member', 'Tambah Anggota') ?></td>
        </tr>
        <tr>
            <td>2016/2017</td>
            <td>II A</td>                        
            <td>David Hume</td>            
            <td><?php echo anchor('student_group/new_member', 'Tambah Anggota') ?></td>
        </tr>
        <tr>
            <td>2016/2017</td>
            <td>II B</td>     
            <td>Galileo Galilei</td>            
            <td><?php echo anchor('student_group/new_member', 'Tambah Anggota') ?></td>
        </tr>
    </tbody>
</table>