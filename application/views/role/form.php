<p>&nbsp;</p>
<?php echo form_open('role/update') ?>
<div class="row">
    <div class="col-lg-6">
        <h3>Hak Akses</h3>        
    </div>
    <div class="col-lg-6">
        <?php
            echo form_hidden('role_name', $role_name);
        ?>
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>    
    </div>
</div>
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
<?php echo form_close() ?>