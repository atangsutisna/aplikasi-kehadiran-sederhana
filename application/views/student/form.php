<div class="col-lg-12">
  <div class="box box-info">
      <div class="box-header with-border">
          FORM SISWA
          <div class="box-tools">
              <?php echo anchor('student', '<< Kembali', array('class' => 'btn btn-primary')) ?>
          </div>
          <br/><br/>
      </div>
      <div class="box-body no-padding">
        <?php 
          $formAttr = array("class" => "form-horizontal");
          echo !isset($siswa) ? form_open("student/insert", $formAttr) : form_open("student/update", $formAttr);
        ?>
        <?php echo validation_errors() ?>
        <?php 
          if ($this->session->flashdata('notif') != NULL) {
              echo "<div class='alert alert-info'>";
              echo $this->session->flashdata('notif');
              echo "</div>";
          }
        ?>
        <div class="form-group">
          <label class="col-sm-2 control-label">ID</label>
          <div class="col-sm-5">
            <?php 
              echo form_hidden('id', isset($siswa) ? $siswa->id : '');
            ?>
            <input type="text" class="form-control" placeholder="Nomer Induk" name="nomor_induk" 
            value="<?php echo isset($siswa) ? $siswa->nomor_induk : ""?>"
            <?php echo isset($siswa) ? 'disabled' : '' ?>>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama lengkap</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" placeholder="Nama lengkap" name="nama_lengkap"
            value="<?php echo isset($siswa) ? $siswa->nama_lengkap : ""?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Jenis Kelamin</label>
          <div class="col-sm-5">
              <div class="radio">
                <label>
                  <?php 
                    $maleRadio = array(
                        'name' => 'jenis_kelamin',
                        'value' => 1,
                        'checked' => isset($siswa) && $siswa->jenis_kelamin == 1 ? TRUE : FALSE
                      );
                    echo form_radio($maleRadio);
                  ?>
                  Laki-laki
                </label>
              </div>
              <div class="radio">
                <label>
                    <?php 
                    $femaleRadio = array(
                        'name' => 'jenis_kelamin',
                        'value' => 0,
                        'checked' => isset($siswa) && $siswa->jenis_kelamin == 0 ? TRUE : FALSE
                      );
                    echo form_radio($femaleRadio);
                  ?>
                  Perempuan
                </label>
              </div>
           </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-5">
            <?php
              $streetAttr = array(
                  'class' => 'form-control',
                  'row' => '3',
                  'name' => 'alamat',
                  'value' => isset($siswa) ? $siswa->alamat : ''
                );
              echo form_textarea($streetAttr);
            ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>        
        <?php echo form_close() ?>
      </div>
  </div>
</div>