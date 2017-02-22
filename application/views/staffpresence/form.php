<p>&nbsp;</p>
<?php echo form_open('staff_presence/insert') ?>
<div class="row">
    <div class="col-lg-5">
        <h3>Absensi Staff</h3>        
    </div>
    <div class="col-lg-7">
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
        </div>
    </div>
</div>
<?php 
if ($this->session->flashdata('notif') != NULL) {
    echo "<div class='alert alert-info'>";
    echo $this->session->flashdata('notif');
    echo "</div>";
}
?>
<br><br>
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
                          'value' => 'TIDAK HADIR',
                          'checked' => $staff->keterangan == 'TIDAK HADIR' ? TRUE : FALSE
                        );
                        echo form_radio($thRadio);
                    ?>
                    Tidak Hadir
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
<?php echo form_close() ?>