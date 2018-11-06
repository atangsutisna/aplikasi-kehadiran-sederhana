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
            <br/>
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
              <label class="col-sm-3 control-label">Username</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Username" name="username" 
                value="<?php echo isset($user) ? $user->username : ""?>"
                <?php echo isset($user) ? 'disabled' : '' ?>>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Staff/Guru</label>
              <div class="col-sm-5">
                <?php
                  $userOpt = array('0' => 'Pilih Staff');
                  foreach($users as $row) {
                    $userOpt[$row->id] = $row->nama;  
                  }
                  echo form_dropdown('id_pengguna', $userOpt, 
                    isset($user) ? $user->id_pengguna : '0', ['class' => 'form-control']);
                ?>              
              </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-3 control-label">Peran</label>
                  <div class="col-sm-4">
                    <?php
                      $peranOpt = array(
                        '0' => 'Pilih Peran',
                        'ADMINISTRATOR' => 'ADMINISTRATOR',
                        'STAFF' => 'STAFF',
                        'USER' => 'USER'
                      );
                      echo form_dropdown('peran', $peranOpt, 
                        isset($user) ? $user->peran : '0', ['class' => 'form-control']);
                    ?>
                  </div>
            </div>  
            <div class="form-group">
              <label class="col-sm-3 control-label">Password</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Username" name="password">     
              </div>
            </div>            
            <div class="form-group">
              <label class="col-sm-3 control-label">Retype Password</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Username" name="retype_password">     
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>            
          </form>
      </div>
  </div>    
</div>  
<p>&nbsp;</p>
<p>&nbsp;</p>