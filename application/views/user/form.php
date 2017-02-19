<p>&nbsp;</p>
<?php 
  $formAttr = array("class" => "form-horizontal");
  echo !isset($user) ? form_open("student/insert", $formAttr) : form_open("student/update", $formAttr);
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM USER</h4>
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
        $positions = array(
            '0' => 'Pilih Staff',
            '1' => 'Albert Einsten',
            '2' => 'Leonardo Davinci',
            '3' => 'Socrates',
          );
        echo form_dropdown('id_staff', $positions, '0');
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