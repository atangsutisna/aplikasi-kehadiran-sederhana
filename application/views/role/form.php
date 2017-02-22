<p>&nbsp;</p>
<h3>Hak Akses</h3>
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
                'name' => 'create_action',
                'checked' => $role->create_action == 1 ? TRUE : FALSE
            );
            echo form_checkbox($create_chbk);
        ?>
    </td>
    <td>
        <?php 
            $read_chbk = array(
                'name' => 'read_action',
                'checked' => $role->create_action == 1 ? TRUE : FALSE
            );
            echo form_checkbox($read_chbk);
        ?>
    </td>
    <td>
        <?php 
            $update_chbk = array(
                'name' => 'update_action',
                'checked' => $role->create_action == 1 ? TRUE : FALSE
            );
            echo form_checkbox($update_chbk);
        ?>
    </td>
    <td>
        <?php 
            $delete_chbk = array(
                'name' => 'delete_action',
                'checked' => $role->create_action == 1 ? TRUE : FALSE
            );
            echo form_checkbox($delete_chbk);
        ?>
    </td>
  </tr>
  <?php endforeach; ?>
</table>