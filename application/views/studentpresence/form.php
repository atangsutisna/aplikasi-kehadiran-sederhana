<p>&nbsp;</p>
<?php 
  $formAttr = array("class" => "form-horizontal");
  echo form_open("student_group/insert_new_member", $formAttr);
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM ABSENSI SISWA</h4>
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
        $tahun_ajaran = array(
            '0' => 'Tahun Ajaran',
            '1' => '2016/2017'
          );
            echo form_dropdown('tahun_ajaran', $tahun_ajaran, '0');
        ?>
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-2 control-label">Kelas</label>
    <div class="col-sm-4">
    <?php
        $students = array(
            '0' => 'Pilih Nama Kelas',
            '1' => 'I A',
            '2' => 'I B',
            '3' => 'II A',
            '4' => 'II B',
          );
            echo form_dropdown('id_staff', $students, '0');
        ?>
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Cari</button>
    </div>
  </div>
<?php echo form_close() ?>
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
        <tr>
            <td>1000001</td>
            <td>Fajar Nugraha</td>            
            <td>
                <label>
                    <input type="checkbox" name="status[]"/> Hadir/Tidak Hadir
                </label>
            </td>
            <td>
                <select>
                    <option value="tidak ada kabar">Tidak ada kabar</option>
                    <option value="sakit">Sakit</option>
                    <option value="ijin">Ijin</option>                    
                </select>
            </td>
        </tr>
        <tr>
            <td>1000002</td>
            <td>Eki Kurniawan</td>            
            <td>
                <label>
                    <input type="checkbox" name="status[]"/> Hadir/Tidak Hadir
                </label>
            </td>
            <td>
                <select>
                    <option value="tidak ada kabar">Tidak ada kabar</option>
                    <option value="sakit">Sakit</option>
                    <option value="ijin">Ijin</option>                    
                </select>
            </td>
        </tr>
        <tr>
            <td>1000003</td>
            <td>Rosa Sukmawati</td>            
            <td>
                <label>
                    <input type="checkbox" name="status[]"/> Hadir/Tidak Hadir
                </label>
            </td>
            <td>
                <select>
                    <option value="tidak ada kabar">Tidak ada kabar</option>
                    <option value="sakit">Sakit</option>
                    <option value="ijin">Ijin</option>                    
                </select>
            </td>
        </tr>
        <tr>
            <td>1000004</td>
            <td>Bela Latjuba</td>            
            <td>
                <label>
                    <input type="checkbox" name="status[]"/> Hadir/Tidak Hadir
                </label>
            </td>
            <td>
                <select>
                    <option value="tidak ada kabar">Tidak ada kabar</option>
                    <option value="sakit">Sakit</option>
                    <option value="ijin">Ijin</option>                    
                </select>
            </td>
        </tr>
    </tbody>
</table>