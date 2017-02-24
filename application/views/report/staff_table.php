<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Report Template</title>
      <!-- Bootstrap core CSS -->
      <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
        <div class="page-header">
            <h1>REKAP ABSENSI STAFF</h1>
            <p class="lead">Tanggal: <?php echo $current_date ?></p>
        </div>
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
    </div> <!-- /container -->
  </body>
</html>
