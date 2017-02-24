<div class="col-lg-12">
    <div class="box box-info">
      <div class="box-header with-border">
          DAFTAR SISWA
          <div class="box-tools">
                <?php echo anchor('student/new_form', 'Tambah Siswa Baru', array('class' => 'btn btn-primary')) ?>
          </div>
          <br/><br/>
      </div>
      <div class="box-body">    
        <?php 
            if ($this->session->flashdata('notif') != NULL) {
                echo "<div class='alert alert-info'>";
                echo $this->session->flashdata('notif');
                echo "</div>";
            }
        ?>   
        <?php echo form_open('student/order', array('class' => 'form-horizontal')) ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Urut berdasarkan</label>
                <div class="col-sm-4">
                <?php
                    $orderByOpt = array(
                        'nomor_induk' => 'NIS',
                        'nama_lengkap' => 'Nama'
                    );
                    echo form_dropdown('order_by', $orderByOpt, isset($selected_order_by) ? $selected_order_by : 'nama_lengkap');
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
                    <th>NIS</th>
                    <th>Nama </th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $siswa) : ?>
                <tr>
                    <td><?php echo $siswa->nomor_induk ?> </td>
                    <td><?php echo $siswa->nama_lengkap ?></td>
                    <td><?php echo $siswa->alamat ?></td>
                    <td><?php echo $siswa->jenis_kelamin ? 'Laki-laki' : 'Perempuan' ?></td>
                    <td>
                        <?php echo anchor('student/edit_student/'. $siswa->id, 'Edit') ?> | 
                        <?php echo anchor('student/delete/'. $siswa->id, 'Delete', array('onclick' =>  
                        "return confirm('Anda yakin akan menghapus ?');")) ?>
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