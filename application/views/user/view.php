<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            DAFTAR PENGGUNA
            <div class="box-tools">
                <?php echo anchor('user/new_form', 'Tambah Pengguna Baru', array('class' => 'btn btn-primary')) ?>
            </div>
            <br/><br/>
        </div>
        <div class="box-body no-padding">
            <?php 
            if ($this->session->flashdata('notif') != NULL) {
                echo "<div class='alert alert-info'>";
                echo $this->session->flashdata('notif');
                echo "</div>";
            }
            ?>      
            <table class="table">
                <thead>
                    <tr>
                        <th>username</th>
                        <th>Nama Lenkap</th>            
                        <th>Peran</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user) : ?>
                    <tr>
                        <td><?php echo $user->username ?></td>
                        <td><?php echo $user->nama ?></td>
                        <td><?php echo $user->peran ?></td>
                        <td><?php echo $user->status == true ? 'AKTIF' : 'NON AKTIF' ?></td>
                        <td>
                            <?php echo anchor('user/edit/'. $user->id_pengguna , 'Edit') ?>  
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>            
        </div>
    </div>
</div>