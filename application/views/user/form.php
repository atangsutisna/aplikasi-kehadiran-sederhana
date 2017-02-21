<p>&nbsp;</p>
<?php 
  $formAttr = array("class" => "form-horizontal");
  echo !isset($user) ? form_open("user/insert", $formAttr) : form_open("user/update", $formAttr);
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM PENGGUNA</h4>
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
    <label class="col-sm-2 control-label">Username</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" placeholder="Username" name="username" 
      value="<?php echo isset($user) ? $user->username : ""?>"
      <?php echo isset($user) ? 'disabled' : '' ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama Staff</label>
    <div class="col-sm-5">
      <?php
        $staffOpt = array('0' => 'Pilih Staff');
        foreach($staffs as $staff) {
          $staffOpt[$staff->id] = $staff->nama;  
        }
        echo form_dropdown('id_pengguna', $staffOpt, isset($user) ? $user->id_pengguna : '0');
      ?>              
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Peran</label>
    <div class="col-sm-4">
      <?php
        $peranOpt = array(
          '0' => 'Pilih Peran',
          'ADMINISTRATOR' => 'ADMINISTRATOR',
          'GURU' => 'GURU',
          'SEKRETARIS_SEKOLAH' => 'SEKRETARIS_SEKOLAH'
        );
        echo form_dropdown('peran', $peranOpt, isset($user) ? $user->peran : '0');
      ?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Password</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" placeholder="Username" name="password">     
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Retype Password</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" placeholder="Username" name="retype_password">     
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
<?php echo form_close() ?>