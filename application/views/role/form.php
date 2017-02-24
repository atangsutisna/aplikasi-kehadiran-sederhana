<?php echo form_open('role/update') ?>
<div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            HAK AKSES
            <div class="box-tools">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>        
            <br/><br/>
        </div>
        <div class="box-body no-padding">
            <?php echo form_hidden('role_name', $role_name) ?>
            <table class="table">
              <tr>
                <th rowspan="2">Nama Modul<br></th>
                <th rowspan="2">Peran</th>
                <th colspan="4">Akses</th>
              </tr>
              <tr>
                <td>CREATE</td>
                <td>READ</td>
                <td>UPDATE</td>
                <td>DELETE</td>
              </tr>
              <?php foreach($roles as $role): ?>
              <tr>
                <td><?php echo $role->module_name ?></td>
                <td><?php echo $role->role ?></td>
                <td>
                    <?php 
                        $create_chbk = array(
                            'name' => 'create_action['. $role->module_id . ']',
                            'value' => $role->create_action == 1 ? TRUE : FALSE,
                            'checked' => $role->create_action == 1 ? TRUE : FALSE
                        );
                        echo form_checkbox($create_chbk);
                    ?>
                </td>
                <td>
                    <?php 
                        $read_chbk = array(
                            'name' => 'read_action['. $role->module_id. ']',
                            'value' => $role->read_action == 1 ? TRUE : FALSE,
                            'checked' => $role->read_action == 1 ? TRUE : FALSE
                        );
                        echo form_checkbox($read_chbk);
                    ?>
                </td>
                <td>
                    <?php 
                        $update_chbk = array(
                            'name' => 'update_action['. $role->module_id . ']',
                            'value' => $role->update_action == 1 ? TRUE : FALSE,
                            'checked' => $role->update_action == 1 ? TRUE : FALSE
                        );
                        echo form_checkbox($update_chbk);
                    ?>
                </td>
                <td>
                    <?php 
                        $delete_chbk = array(
                            'name' => 'delete_action['. $role->module_id . ']',
                            'value' => $role->delete_action == 1 ? TRUE : FALSE,
                            'checked' => $role->delete_action == 1 ? TRUE : FALSE
                        );
                        echo form_checkbox($delete_chbk);
                    ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </table>
            <p>&nbsp;</p>
            
        </div>        
    </div>    
</div>
<?php echo form_close() ?>
<p>&nbsp;</p>