<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            FORM REKAP STAFF
        </div>
        <div class="box-body no-padding">
            <?php echo form_open('report/staff', array("class" => "form-horizontal")) ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pilih Bulan</label>
                        <div class="col-sm-4">
                            <?php
                                $monthOpt = array();
                                for ($i=1; $i <= 12; $i++) {
                                    $monthOpt[$i] = $i;
                                }
                                echo form_dropdown('month', $monthOpt, '1');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pilih Tahun</label>
                        <div class="col-sm-4">
                            <?php
                                $yearOpt[date('Y') - 1] = date('Y') - 1;
                                $yearOpt[date('Y')] = date('Y');
                                $yearOpt[date('Y') + 1] = date('Y') + 1;
                                echo form_dropdown('year', $yearOpt, date('Y'));
                            ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                Rekap
                            </button>
                        </div>
                    </div>
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="box">
        <div class="box-header">
            LAPORAN ABSENSI STAFF
            <div class="box-tools">
                <?php echo form_open('report/print_pdf_staff_report') ?>
                <?php echo form_hidden('month', isset($month) ? $month : '') ?>
                <?php echo form_hidden('year', isset($year) ? $year : '') ?>
                <button class="btn btn-primary" <?php echo count($staffs) == 0 ? 'disabled' : ''?>>
                    Cetak PDF
                </button>
                <?php form_close(); ?>
                <button class="btn btn-primary">
                    Covert to CSV
                </button>
            </div>
        </div>
        <div class="box-body no-padding">    
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Hadir</th>
                        <th>Alpa</th>
                        <th>Ijin</th>
                        <th>Sakit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($staffs as $idx => $value) : ?>
                    <tr>
                        <td><?php echo $idx + 1?></td>
                        <td><?php echo $value->nip ?></td>
                        <td><?php echo $value->nama_lengkap ?></td>
                        <td><?php echo $value->nama_jabatan ?></td>
                        <td>
                           <?php echo $value->count_hadir ?>
                        </td>
                        <td>
                            <?php echo $value->count_alpa ?>
                        </td>
                        <td>
                            <?php echo $value->count_ijin ?>
                        </td>
                        <td>
                            <?php echo $value->count_sakit ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>        
    </div>
</div>
<p>&nbsp;</p>