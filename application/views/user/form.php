<div class="col-lg-12">
  <div class="box box-info">
        <div class="box-header with-border">
            FORM PENGGUNA
            <div class="box-tools">
                <?php echo anchor('user', '<< Kembali', array('class' => 'btn btn-primary')) ?>
            </div>
            <br/><br/>
        </div>
        <div class="box-body no-padding">
            <?php 
              $formAttr = array("class" => "form-horizontal");
              echo !isset($user) ? form_open("user/insert", $formAttr) : form_open("user/update", $formAttr);
                      
              echo validation_errors();
            
              if ($this->session->flashdata('notif') != NULL) {
                  echo "<div class='alert alert-info'>";
                  echo $this->session->flashdata('notif');
                  echo "</div>";
              }
            ?>          
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
                    'STAFF' => 'STAFF'
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
        </div>
        <!-- end of box body -->
  </div>    
</div>  