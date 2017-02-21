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
<php echo form_open('#') ?>
<div class="row">
    <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </div>
</div>
<br><br>
<table class="table">
    <tdead>
        <tr>
            <th>NIS</th>
            <th>Nama Siswa</th>            
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
    </tdead>
    <tbody>
        <?php foreach ($group_members as $member) : ?>
        <tr>
            <td><?php echo $member->nomor_induk ?></td>
            <td><?php echo $member->nama_lengkap ?></td>            
            <td>
                <label>
                    <?php 
                        $ckdata = array(
                            'name' => 'status['. $member->id_siswa . ']'
                        );
                        echo form_checkbox($ckdata);
                    ?>
                    Hadir/Tidak Hadir
                </label>
            </td>
            <td>
                <?php 
                    $descOpt = array(
                        'TIDAK ADA KABAR' => 'Tidak ada kabar',
                        'SAKIT' => 'SAKIT',
                        'IJIN' => 'IJIN',
                    );
                    echo form_dropdown('keterangan['. $member->id_siswa . ']', $descOpt);
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo form_close() ?>