<p>&nbsp;</p>
<?php 
  $formAttr = array("class" => "form-horizontal");
  echo !isset($staff) ? form_open("student/insert", $formAttr) : form_open("student/update", $formAttr);
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM STAFF</h4>
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
    <label class="col-sm-2 control-label">ID</label>
    <div class="col-sm-5">
      <?php 
        echo form_hidden('id', isset($staff) ? $staff->id : '');
      ?>
      <input type="text" class="form-control" placeholder="NIP jika pns" name="id_staff" 
      value="<?php echo isset($staff) ? $staff->id_staff : ""?>"
      <?php echo isset($staff) ? 'disabled' : '' ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama lengkap</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" placeholder="Nama lengkap" name="nama_lengkap"
      value="<?php echo isset($staff) ? $staff->nama_lengkap : ""?>">
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
    <div class="col-sm-5">
      <?php
        $positions = array(
            '0' => 'Pilih Jabatan',
            'kepsek' => 'Kepala Sekolah',
            'wakepsek' => 'Wakil Kepala Sekolah',
            'guru' => 'Guru',
          );
        echo form_dropdown('id_jabatan', $positions, '0');
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
                  'name' => 'pendidikan',
                  'value' => 's1',
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
                  'name' => 'pendidikan',
                  'value' => 'sma',
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
                  'name' => 'pendidikan',
                  'value' => 'smp',
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
                  'name' => 'pendidikan',
                  'value' => 'sd',
                );
              echo form_radio($sdRadio);
            ?>
            SD
          </label>
        </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
<?php echo form_close() ?>