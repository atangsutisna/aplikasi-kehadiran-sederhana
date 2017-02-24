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
                            <label>
                                <?php 
                                    $hRadio = array(
                                      'name' => 'keterangan['.$staff->id_staff.']',
                                      'value' => 'HADIR',
                                      'checked' => $staff->keterangan == 'HADIR' ? TRUE : FALSE
                                    );
                                    echo form_radio($hRadio);
                                ?>
                                Hadir
                            </label>
                            <label>
                                <?php 
                                    $thRadio = array(
                                      'name' => 'keterangan['.$staff->id_staff.']',
                                      'value' => 'ALPA',
                                      'checked' => $staff->keterangan == 'ALPA' ? TRUE : FALSE
                                    );
                                    echo form_radio($thRadio);
                                ?>
                                Alpa
                            </label>
                            <label>
                                <?php 
                                    $sRadio = array(
                                      'name' => 'keterangan['.$staff->id_staff.']',
                                      'value' => 'SAKIT',
                                      'checked' => $staff->keterangan == 'SAKIT' ? TRUE : FALSE
                                    );
                                    echo form_radio($sRadio);
                                ?>
                                SAKIT
                            </label>
                            <label>
                                <?php 
                                    $iRadio = array(
                                      'name' => 'keterangan['.$staff->id_staff.']',
                                      'value' => 'IJIN',
                                      'checked' => $staff->keterangan == 'IJIN' ? TRUE : FALSE                          
                                    );
                                    echo form_radio($iRadio);
                                ?>
                                IJIN
                            </label>
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