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
            <h1>REKAP ABSENSI SISWA</h1>
            <p class="lead"><?php echo $current_date ?></p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Hadir</th>
                    <th>Alpa</th>
                    <th>Ijin</th>
                    <th>Sakit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $idx => $value) : ?>
                <tr>
                    <td><?php echo $idx + 1?></td>
                    <td><?php echo $value->nomor_induk ?></td>
                    <td><?php echo $value->nama_lengkap ?></td>
                    <td><?php echo $value->nama_kelas ?></td>
                    <td>
                       <?php if ($value->keterangan == 'HADIR') : ?>
                           <i class="fa fa-check" aria-hidden="true"></i>
                       <?php endif; ?>
                    </td>
                    <td>
                       <?php if ($value->keterangan == 'ALPA') : ?>
                           <i class="fa fa-check" aria-hidden="true"></i>
                       <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($value->keterangan == 'IJIN') : ?>
                           <i class="fa fa-check" aria-hidden="true"></i>
                       <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($value->keterangan == 'SAKIT') : ?>
                           <i class="fa fa-check" aria-hidden="true"></i>
                       <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div> <!-- /container -->
  </body>
</html>
