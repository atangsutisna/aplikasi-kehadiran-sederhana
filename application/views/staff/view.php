<div class="col-lg-12">
    <div class="box">
        <div class="box-header">
            DAFTAR STAFF
            <div class="box-tools">
                <?php echo anchor('staff/new_form', 'Tambah Staff Baru', array('class' => 'btn btn-primary')) ?>                
            </div>
        </div>        
    <div class="box-body">    
        <?php 
        if ($this->session->flashdata('notif') != NULL) {
            echo "<div class='alert alert-info'>";
            echo $this->session->flashdata('notif');
            echo "</div>";
        }
        ?>    
        <?php echo form_open('staff/filter', array('class' => 'form-horizontal')) ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-4">
                    <?php
                    $posOpt = array('0' => 'Pilih Jabatan');
                    foreach ($positions as $item) {
                        $posOpt[$item->id] = $item->nama_jabatan;
                    }
                    echo form_dropdown('id_jabatan', $posOpt, isset($selected_position_id) ? $selected_position_id : '0');
                    ?>                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Urut berdasarkan</label>
                <div class="col-sm-4">
                <?php
                    $orderByOpt = array(
                        'nip' => 'NIP',
                        'nama' => 'Nama',
                        'nama_jabatan' => 'Jabatan'
                    );
                    echo form_dropdown('order_by', $orderByOpt, isset($selected_order_by) ? $selected_order_by : 'nama');
                    $order_desc = array('asc' => 'ASC', 'desc' => 'DESC');
                    echo form_dropdown('order_desc', $order_desc, isset($selected_order_desc) ? $selected_order_desc : 'asc');
                ?>
                </div>
            </div>                
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
              </div>
            </div>            
        <?php echo form_close() ?>        
        <table class="table">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama </th>
                    <th>Jabatan</th>
                    <th>Pendidikan</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staffs as $staff) : ?>
                <tr>
                    <td><?php echo $staff->nip ?></td>
                    <td><?php echo $staff->nama ?></td>
                    <td><?php echo $staff->nama_jabatan ?></td>
                    <td><?php echo $staff->pendidikan_terakhir ?></td>
                    <td><?php echo $staff->status ?></td>
                    <td>
                        <?php echo anchor('staff/edit/'. $staff->id, 'Edit') ?>
                    </td>
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