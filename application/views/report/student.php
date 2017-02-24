<div class="col-lg-12">
    <div class="box">
        <div class="box-header">
            LAPORAN ABSENSI SISWA
            <div class="box-tools">
                <?php echo anchor('report', '<< Kembali', array('class' => 'btn btn-primary')) ?>                
                <?php echo anchor('report', 'Cetak PDF', array('class' => 'btn btn-primary')) ?>      
            </div>
        </div>
        <div class="box-body no-padding">    
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Hadir</th>
                        <th>Alpa</th>
                        <th>Ijin</th>
                        <th>Sakit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $idx => $value) : ?>
                    <tr>
                        <td><?php echo $idx + 1?></td>
                        <td><?php echo $value->nomor_induk ?></td>
                        <td><?php echo $value->nama_lengkap ?></td>
                        <td><?php echo $value->nama_kelas ?></td>
                        <td>
                           <?php if ($value->keterangan == 'HADIR') : ?>
                               <i class="fa fa-check" aria-hidden="true"></i>
                           <?php endif; ?>
                        </td>
                        <td>
                           <?php if ($value->keterangan == 'ALPA') : ?>
                               <i class="fa fa-check" aria-hidden="true"></i>
                           <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($value->keterangan == 'IJIN') : ?>
                               <i class="fa fa-check" aria-hidden="true"></i>
                           <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($value->keterangan == 'SAKIT') : ?>
                               <i class="fa fa-check" aria-hidden="true"></i>
                           <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>        
    </div>
</div>