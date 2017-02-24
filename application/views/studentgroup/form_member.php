<div class="col-lg-12">
    <div class="box box-info">
      <div class="box-header with-border">
        FORM TAMBAH ANGGOTA KELAS
        <div class="box-tools">
            <?php echo anchor('student_group', '<< Kembali', array('class' => 'btn btn-primary')) ?>
        </div>
        <br/><br/>
      </div>
      <div class="box-body no-padding">
        <?php 
          $formAttr = array("class" => "form-horizontal");
          echo form_open("student_group/insert_new_member", $formAttr);
        ?>        
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <h4></h4>
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
              echo form_hidden('id_kelas', isset($stdgroup_id) ? $stdgroup_id : '');
              $stdOpt = array('0' => 'Pilih Nama Siswa');
              foreach ($students as $student) {
                $stdOpt[$student->id] = $student->nama_lengkap;
              }
              echo form_dropdown('id_siswa', $stdOpt, '0');
              ?>
          </div>
        </div>  
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
        <?php echo form_close() ?>
        <!-- table -->
        <table class="table">
            <tdead>
                <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>            
                    <th>#</th>
                </tr>
            </tdead>
            <tbody>
                <?php foreach($group_members as $member) : ?>
                <tr>
                    <td><?php echo $member->nomor_induk ?></td>
                    <td><?php echo $member->nama_lengkap ?></td>            
                    <td><?php echo anchor('student_group/delete_member/'. $member->id_kelas . '/'. $member->id_siswa, 'Delete') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div>      
    </div>
</div>
<p>&nbsp;</p>