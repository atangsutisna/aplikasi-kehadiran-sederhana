<p>&nbsp;</p>
<?php 
  $formAttr = array("class" => "form-horizontal");
  echo !isset($kelas) ? form_open("student/insert", $formAttr) : form_open("student/update", $formAttr);
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM KELAS</h4>
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
    <label class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" placeholder="Tulis nama kelas" name="nama_kelas" 
      value="<?php echo isset($kelas) ? $kelas->nama_kelas : ""?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tahun Ajaran</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" placeholder="Contoh 2016/2017" name="tahun_ajaran" 
      value="<?php echo isset($kelas) ? $kelas->tahun_ajaran : ""?>">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-2 control-label">Wali Kelas</label>
    <div class="col-sm-4">
      <?php
        $positions = array('0' => 'Pilih Wali Kelas');
        foreach ($staffs as $staff) {
          $positions[$staff->id] = $staff->nama;
        }
        echo form_dropdown('id_staff', $positions, '0');
      ?>      
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
<?php echo form_close() ?>