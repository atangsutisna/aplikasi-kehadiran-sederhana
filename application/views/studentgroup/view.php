<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header">
            Daftar Kelas
            <div class="box-tools">
                <?php echo anchor('student_group/new_form', 'Tambah Kelas Baru', array('class' => 'btn btn-primary')) ?>            
            </div>
            <br/><br/>
        </div>
        <div class="box-body no-padding">   
            <?php 
            if ($this->session->flashdata('notif') != NULL) {
                echo "<div class='alert alert-info'>";
                echo $this->session->flashdata('notif');
                echo "</div>";
            }
            ?>
            <table class="table">
                <tdead>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Nama Kelas</th>
                        <!--
                        <th>Wali Kelas</th>
                        -->
                        <th>Total Siswa</th>            
                        <th>#</th>
                    </tr>
                </tdead>
                <tbody>
                    <?php foreach ($groups as $group) : ?>
                    <tr>
                        <td><?php echo $group->tahun_ajaran ?></td>
                        <td><?php echo $group->nama_kelas ?></td>
                        <!--<td><?php //echo $group->wali_kelas == null ? 'Belum ada' : $group->wali_kelas ?></td>-->       
                        <td><?php echo $group->total_siswa != null ? $group->total_siswa : 0 ?></td>
                        <td>
                            <?php echo anchor('student_group/edit/'. $group->id, 'Edit') ?> | 
                            <?php echo anchor('student_group/new_member/'.$group->id, 'Tambah Anggota') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>            
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
    </div>
</div>