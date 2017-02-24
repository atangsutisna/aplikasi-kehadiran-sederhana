<?php echo form_open('staff_presence/insert') ?>
<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            ABSENSI STAFF: <?php echo date('d-m-Y') ?>
            <div class="box-tools">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
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
                        <th>NIS</th>
                        <th>Nama Siswa</th>            
                        <th>Keterangan</th>
                    </tr>
                </tdead>
                <tbody>
                    <?php foreach ($staffs as $staff) : ?>
                    <tr>
                        <td>
                            <?php 
                                echo form_hidden('id_kehadiran['. $staff->id_staff . ']', $staff->id_kehadiran != NULL ? $staff->id_kehadiran : NULL);
                                echo $staff->nip 
                            ?>
                        </td>
                        <td><?php echo $staff->nama ?></td>            
                        <td>
                            <?php 
                                $descOpt = array(
                                    'HADIR' => 'HADIR',
                                    'ALPA' => 'ALPA',
                                    'SAKIT' => 'SAKIT',
                                    'IJIN' => 'IJIN',
                                );
                                echo form_dropdown('keterangan['. $staff->id_staff .']', $descOpt, 'HADIR');
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>            
        </div>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
<?php echo form_close() ?>
<p>&nbsp;</p>