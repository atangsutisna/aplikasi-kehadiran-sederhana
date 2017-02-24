<div class="col-lg-12">
    <div class="box box-info">
      <div class="box-header with-border">
          RINGKASAN ABSENSI SISWA <b>HADIR:</b> <?php echo $count_hadir ?>, <b>ALPA</b> <?php echo $count_alpa ?>
          <b>SAKIT:</b> <?php echo $count_sakit ?>  <b>IJIN:</b> <?php echo $count_ijin ?>
          <div class="box-tools">
                <?php echo anchor('student_presence', '<< Kembali', array('class' => 'btn btn-primary')) ?>
          </div>
          <br/><br/>
      </div>
      <div class="box-body no-padding">    
            <table class="table">
                <tdead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>            
                        <th>Keterangan</th>
                    </tr>
                </tdead>
                <tbody>
                    <?php foreach ($group_members as $member) : ?>
                    <tr>
                        <td>
                            <?php 
                                echo form_hidden('id_kehadiran['. $member->id_siswa . ']', $member->id_kehadiran != NULL ? $member->id_kehadiran : NULL);
                                echo $member->nomor_induk 
                            ?>
                        </td>
                        <td><?php echo $member->nama_lengkap ?></td>            
                        <td>
                            <?php echo $member->keterangan ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>        
      </div>
    </div>
</div>
<p>&nbsp;</p>