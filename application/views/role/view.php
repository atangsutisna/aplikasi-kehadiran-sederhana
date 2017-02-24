<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            PERAN
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
                        <td>No</td>
                        <td>Peran</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ADMINISTRATOR</td>
                        <td><?php echo anchor('role/edit/administrator', 'Hak Akses') ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>STAFF</td>
                        <td>
                            <?php echo anchor('role/edit/staff', 'Hak Akses') ?>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>USER</td>
                        <td>
                            <?php echo anchor('role/edit/user', 'Hak Akses') ?>
                        </td>
                    </tr>
                </tbody>
            </table>            
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>            
    </div>        
</div>    
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

