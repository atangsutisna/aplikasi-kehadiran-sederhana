<p>&nbsp;</p>
<?php echo form_open("student/insert", array("class" => "form-horizontal")) ?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM SISWA</h4>
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
    <label class="col-sm-2 control-label">NIS</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" placeholder="Nomer Induk" name="nomor_induk" 
      <?php echo set_value('nomor_induk') ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama lengkap</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" placeholder="Nama lengkap" name="nama_lengkap"
      <?php echo set_value('nama_lengkap') ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Jenis Kelamin</label>
    <div class="col-sm-5">
        <div class="radio">
          <label>
            <input type="radio" name="jenis_kelamin" value="1" <?php echo set_value('jenis_kelamin') ?>> Laki-laki
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="jenis_kelamin" value="0" <?php echo set_value('jenis_kelamin') ?>> Perempuan
          </label>
        </div>
     </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-5">
      <textarea class="form-control" rows="3" name="alamat">
          <?php echo set_value('alamat') ?>
      </textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
<?php echo form_close() ?>