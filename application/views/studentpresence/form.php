<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            FORM FILTER SISWA
        </div>
        <div class="box-body no-padding">
            <?php echo validation_errors() ?>
            <?php 
                if ($this->session->flashdata('notif') != NULL) {
                    echo "<div class='alert alert-info'>";
                    echo $this->session->flashdata('notif');
                    echo "</div>";
                }
            ?>
            <?php 
                $formAttr = array("class" => "form-horizontal");
                echo !isset($stdgroup) ? form_open("student_presence/show_group", $formAttr) : form_open("student_presence/new_presence", $formAttr)
            ?>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Pilih Tahun Ajaran</label>
                    <div class="col-sm-4">
                    <?php
                        $opt_thnajr = array(
                            '0' => 'Tahun Ajaran'
                          );
                        foreach ($tahun_ajaran as $value) {
                            $opt_thnajr[$value->tahun_ajaran] = $value->tahun_ajaran;
                        }
                        echo form_dropdown('tahun_ajaran', $opt_thnajr, '0', array('onchange' => 'this.form.submit()'));
                    ?>
                    </div>
                </div>     
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kelas</label>
                    <div class="col-sm-4">
                    <?php
                        $groups = array();
                        if (isset($stdgroup)) {
                            foreach ($stdgroup as $value) {
                               $groups[$value->id] = $value->nama_kelas . " (". $value->tahun_ajaran . ")";
                            } 
                        }
                        echo form_dropdown('id_kelas', $groups, '0');
                        ?>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" <?php echo !isset($stdgroup) ? "disabled" : ""?>>
                          Cari
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!--design baru -->
<?php echo !empty($group_members) ? form_open('student_presence/insert') : form_open('#')?>
<div class="col-lg-12">
    <div class="box">
        <div class="box-header">
            <?php echo isset($group_name) ? '<h3>Absensi Kelas: '. $group_name->nama_kelas . ' '. $group_name->tahun_ajaran . '</h3>' : '' ?>    
            <br/>Tanggal: <?php echo date('d/m/Y') ?>
            <div class="box-tools">
                <?php echo form_hidden('id_kelas', isset($group_name) ? $group_name->id : '') ?>
                <button type="submit" class="btn btn-primary" <?php echo empty($group_members) ? 'disabled' : ''?>>
                    Simpan
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <table class="table">
                <tdead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>            
                        <th>Keterangan</th>
                    </tr>
                </tdead>
                <tbody>
                    <?php foreach ($group_members as $member) : ?>
                    <tr>
                        <td>
                            <?php 
                                echo form_hidden('id_kehadiran['. $member->id_siswa . ']', $member->id_kehadiran != NULL ? $member->id_kehadiran : NULL);
                                echo $member->nomor_induk 
                            ?>
                        </td>
                        <td><?php echo $member->nama_lengkap ?></td>            
                        <td>
                            <?php 
                                $descOpt = array(
                                    'HADIR' => 'HADIR',
                                    'ALPA' => 'ALPA',
                                    'SAKIT' => 'SAKIT',
                                    'IJIN' => 'IJIN',
                                );
                                echo form_dropdown('keterangan['. $member->id_siswa .']', $descOpt, 'HADIR');
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>        
        </div>
    </div>    
</div>
<?php echo form_close() ?>
<p>&nbsp;</p>