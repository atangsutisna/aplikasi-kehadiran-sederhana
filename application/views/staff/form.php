<div class="col-lg-12">
  <div class="box box-info">
      <div class="box-header with-border">
          FORM STAFF
          <div class="box-tools">
              <?php echo anchor('staff', '<< Kembali', array('class' => 'btn btn-primary')) ?>
          </div>
          <br/><br/>
      </div>        
      <div class="box-body no-padding">      
        <?php 
          $formAttr = array("class" => "form-horizontal");
          echo !isset($staff) ? form_open("staff/insert", $formAttr) : form_open("staff/update", $formAttr);
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
          <label class="col-sm-2 control-label">NIP</label>
          <div class="col-sm-5">
            <?php 
              echo form_hidden('id', isset($staff) ? $staff->id : '');
            ?>
            <input type="text" class="form-control" placeholder="NIP.." name="nip" 
            value="<?php echo isset($staff) ? $staff->nip : ""?>"
            <?php echo isset($staff) ? 'disabled' : '' ?>>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama lengkap</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" placeholder="Nama lengkap" name="nama"
            value="<?php echo isset($staff) ? $staff->nama : ""?>">
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
                        'checked' => isset($staff) && $staff->jenis_kelamin == 1 ? TRUE : FALSE
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
                        'checked' => isset($staff) && $staff->jenis_kelamin == 0 ? TRUE : FALSE
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
                  'value' => isset($staff) ? $staff->alamat : ''
                );
              echo form_textarea($streetAttr);
            ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Jabatan</label>
          <div class="col-sm-3">
            <?php
              $postOption = array(
                  '0' => 'Pilih Jabatan',
              );
              foreach ($positions as $item) {
                $postOption[$item->id] = $item->nama_jabatan;
              } 
              
              echo form_dropdown('id_jabatan', $postOption, 
                isset($staff) ? $staff->id_jabatan : '0', 
                ['class' => 'form-control']);
            ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Pendidikan Terakhir</label>
          <div class="col-sm-5">
              <div class="radio">
                <label>
                  <?php 
                    $s1Radio = array(
                        'name' => 'pendidikan_terakhir',
                        'value' => 'S1',
                        'checked' => isset($staff) && $staff->pendidikan_terakhir == 'S1' ? TRUE : FALSE
                      );
                    echo form_radio($s1Radio);
                  ?>
                  S1
                </label>
              </div>
              <div class="radio">
                <label>
                  <?php 
                    $smaRadio = array(
                        'name' => 'pendidikan_terakhir',
                        'value' => 'SMA',
                        'checked' => isset($staff) && $staff->pendidikan_terakhir == 'SMA' ? TRUE : FALSE
                      );
                    echo form_radio($smaRadio);
                  ?>
                  SMA
                </label>
              </div>
              <div class="radio">
                <label>
                  <?php 
                    $smpRadio = array(
                        'name' => 'pendidikan_terakhir',
                        'value' => 'SMP',
                        'checked' => isset($staff) && $staff->pendidikan_terakhir == 'SMP' ? TRUE : FALSE
                      );
                    echo form_radio($smpRadio);
                  ?>
                  SMP
                </label>
              </div>
              <div class="radio">
                <label>
                  <?php 
                    $sdRadio = array(
                        'name' => 'pendidikan_terakhir',
                        'value' => 'SD',
                        'checked' => isset($staff) && $staff->pendidikan_terakhir == 'SD' ? TRUE : FALSE
                      );
                    echo form_radio($sdRadio);
                  ?>
                  SD
                </label>
              </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-2">
            <?php
              $statusOpt = array(
                'AKTIF' => 'AKTIF',
                'NON_AKTIF' => 'NON AKTIF',
                'VOID' => 'VOID'
              );
              echo form_dropdown('status', $statusOpt, 'AKTIF', ['class' => 'form-control']);
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
<p>&nbsp;</p>

