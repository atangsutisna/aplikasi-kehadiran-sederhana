<p>&nbsp;</p>
<h3>Peran</h3>
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
            <td><?php echo anchor('role/edit/administrator', 'View') ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>STAFF</td>
            <td>
                <?php echo anchor('role/edit/staff', 'View') ?>
            </td>
        </tr>
    </tbody>
</table>