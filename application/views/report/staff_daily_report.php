<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            FORM REKAP STAFF
        </div>
        <div class="box-body no-padding">
            <?php echo form_open('report/staff_daily_report', array("class" => "form-horizontal")) ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pilih Tanggal</label>
                        <div class="col-sm-7">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" name="start_date" id="start_date">
                                <div class="input-group-addon">to</div>
                                <input type="text" class="form-control" name="end_date" id="end_date">
                            </div>
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
            </div>
        </div>
        <div class="box-body">    
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
<script type="text/javascript">
//$('#yearpicker').monthpicker();
  $.fn.datepicker.defaults.format = "dd/mm/yyyy";    
  $(document).ready(function(){
    $('#start_date').datepicker();
    $('#end_date').datepicker();
  });
</script>