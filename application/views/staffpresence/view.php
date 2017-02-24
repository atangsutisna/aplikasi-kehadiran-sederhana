<div class="col-lg-12">
    <div class="box box-info">
      <div class="box-header with-border">
          RINGKASAN ABSENSI STAFF <b>HADIR:</b> <?php echo $count_hadir ?>, <b>ALPA</b> <?php echo $count_alpa ?>
          <b>SAKIT:</b> <?php echo $count_sakit ?>  <b>IJIN:</b> <?php echo $count_ijin ?>
          <div class="box-tools">
                <?php echo anchor('staff_presence', '<< Kembali', array('class' => 'btn btn-primary')) ?>
          </div>
          <br/><br/>
      </div>
      <div class="box-body no-padding">    
            <table class="table">
                <tdead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Staff</th>            
                        <th>Keterangan</th>
                    </tr>
                </tdead>
                <tbody>
                    <?php foreach ($group_members as $member) : ?>
                    <tr>
                        <td>
                            <?php 
                                echo $member->nip 
                            ?>
                        </td>
                        <td><?php echo $member->nama ?></td>            
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