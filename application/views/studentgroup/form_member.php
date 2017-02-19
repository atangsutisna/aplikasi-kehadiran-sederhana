<p>&nbsp;</p>
<?php 
  $formAttr = array("class" => "form-horizontal");
  echo form_open("student_group/insert_new_member", $formAttr);
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <h4>FORM TAMBAH ANGGOTA KELAS</h4>
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
    <label class="col-sm-2 control-label">Nama Siswa</label>
    <div class="col-sm-4">
    <?php
        $students = array(
            '0' => 'Pilih Nama Siswa',
            '1' => 'Johan',
            '2' => 'Dadan',
            '3' => 'Kiki Kurniawan',
          );
            echo form_dropdown('id_staff', $students, '0');
        ?>
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Tambah</button>
    </div>
  </div>
<?php echo form_close() ?>
<table class="table">
    <tdead>
        <tr>
            <th>NIS</th>
            <th>Nama Siswa</th>            
            <th>#</th>
        </tr>
    </tdead>
    <tbody>
        <tr>
            <td>1000001</td>
            <td>Fajar Nugraha</td>            
            <td><?php echo anchor('student_group/remove_member/', 'Delete') ?></td>
        </tr>
        <tr>
            <td>1000002</td>
            <td>Eki Kurniawan</td>            
            <td><?php echo anchor('student_group/remove_member/', 'Delete') ?></td>
        </tr>
        <tr>
            <td>1000003</td>
            <td>Rosa Sukmawati</td>            
            <td><?php echo anchor('student_group/remove_member/', 'Delete') ?></td>
        </tr>
        <tr>
            <td>1000004</td>
            <td>Bela Latjuba</td>            
            <td><?php echo anchor('student_group/remove_member/', 'Delete') ?></td>
        </tr>
    </tbody>
</table>