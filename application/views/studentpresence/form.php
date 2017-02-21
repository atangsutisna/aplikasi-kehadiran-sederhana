<p>&nbsp;</p>
<?php 
  $formAttr = array("class" => "form-horizontal");
  echo !isset($stdgroup) ? form_open("student_presence/show_group", $formAttr) : form_open("student_presence/new_presence", $formAttr)
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM FILTER SISWA</h4>
      <?php echo validation_errors() ?>
      <?php 
        if ($this->session->flashdata('notif') != NULL) {
            echo "<div class='alert alert-info'>";
            echo $this->session->flashdata('notif');
            echo "</div>";
        }
      ?>
    </div>
  </div>
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
<?php echo form_close() ?>
<br/>
<?php echo !empty($group_members) ? form_open('student_presence/insert') : form_open('#')?>
<div class="row">
    <div class="col-lg-5">
        <?php echo isset($group_name) ? '<h3>Absensi Kelas: '. $group_name->nama_kelas . ' '. $group_name->tahun_ajaran . '</h3>' : '' ?>        
    </div>
    <div class="col-lg-7">
        <div class="pull-right">
            <button type="submit" class="btn btn-primary" <?php echo empty($group_members) ? 'disabled' : ''?>>
                Simpan
            </button>
        </div>
    </div>
</div>
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
                <label>
                    <?php 
                        $hRadio = array(
                          'name' => 'keterangan['.$member->id_siswa.']',
                          'value' => 'HADIR',
                          'checked' => $member->keterangan == 'HADIR' ? TRUE : FALSE
                        );
                        echo form_radio($hRadio);
                    ?>
                    Hadir
                </label>
                <label>
                    <?php 
                        $thRadio = array(
                          'name' => 'keterangan['.$member->id_siswa.']',
                          'value' => 'TIDAK HADIR',
                          'checked' => $member->keterangan == 'TIDAK HADIR' ? TRUE : FALSE
                        );
                        echo form_radio($thRadio);
                    ?>
                    Tidak Hadir
                </label>
                <label>
                    <?php 
                        $sRadio = array(
                          'name' => 'keterangan['.$member->id_siswa.']',
                          'value' => 'SAKIT',
                          'checked' => $member->keterangan == 'SAKIT' ? TRUE : FALSE
                        );
                        echo form_radio($sRadio);
                    ?>
                    SAKIT
                </label>
                <label>
                    <?php 
                        $iRadio = array(
                          'name' => 'keterangan['.$member->id_siswa.']',
                          'value' => 'IJIN',
                          'checked' => $member->keterangan == 'IJIN' ? TRUE : FALSE                          
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