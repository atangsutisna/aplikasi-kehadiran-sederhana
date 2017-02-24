<div class="col-lg-12">
    <div class="box">
        <div class="box-header">
            LAPORAN ABSENSI
        </div>
        <div class="box-body">
            Pilih bulan
            <?php
                $monthOpt = array();
                for ($i=1; $i <= 12; $i++) {
                    $monthOpt[$i] = $i;
                }
                echo form_dropdown('month', $monthOpt, '1');
            ?>
            Pilih Tahun
            <?php
                $yearOpt[date('Y') - 1] = date('Y') - 1;
                $yearOpt[date('Y')] = date('Y');
                $yearOpt[date('Y') + 1] = date('Y') + 1;
                echo form_dropdown('year', $yearOpt, date('Y'));
            ?>
            <br/><br/>
            <?php echo anchor('report/student', 'Rekap Absensi Siswa', array('class' => 'btn btn-primary')) ?> 
            <?php echo anchor('report/staff', 'Rekap Absensi Staff', array('class' => 'btn btn-primary')) ?> 
        </div>
    </div>
</div>
<p>&nbsp;</p>
