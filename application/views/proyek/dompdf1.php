<!DOCTYPE html>
<html>
<head>  
  <title>RAB PT. ADM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/_all-skins.min.css') ?>"> 
  <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
</head>
<body>

  <img src="<?php echo base_url('/images/pt_adm.jpg') ?>" style="position: absolute; width: 140px; height: auto;">
  <table style="width: 100%;">
    <tr>
      <td align="center">
        <h4 style="line-height: 1.6; font-weight: bold;">
          PT. Astra Daihatsu Motor
        </h4>
      </td>
    </tr>
  </table>
  <br>
  <hr class= "line-title">


          <h4 align="center" style="font-weight: bold;">
            Bill Of Quantity <br/>
            <?= $proyek['project_name']; ?>
          </h4>
          
          <table>
            <tr>
              <td><span style="font-weight: bold;">Plant Name </span></td>
              <td><span style="font-weight: bold;"> : <?= $proyek1['plant_name']; ?></span></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold;">User Name/Ext </span></td>
              <td><span style="font-weight: bold;"> : <?= $proyek1['username']; ?> / <?= $proyek1['ext']; ?></span></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold;">Departement </span></td>
              <td><span style="font-weight: bold;">: <?= $proyek1['departement']; ?></span></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold;">Registration No </span></td>
              <!-- substr itu buat ambil data di database hanya sebagian nilai string nya saja, cek di web https://www.duniailkom.com/tutorial-php-cara-memotong-atau-mengambil-sebagian-string-fungsi-substr/ -->
              <td><span style="font-weight: bold;"> : RAB / <?= substr($proyek['create_date'], 2); ?> / <?= $proyek['id_proyek']; ?></span></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold;">Document Date</span></td>
              <td><span style="font-weight: bold;"> : <?= $proyek['due_date']; ?></span></td>
            </tr>
            <tr>
              <td><span style="font-weight: bold;">Revision </span></td>
              <td><span style="font-weight: bold;"> : <?= $proyek['revision']; ?></span></td>
            </tr>
            
          </table>
          <br>

            <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td align="center" width="20px" style="font-size: 8pt;"><strong>No</strong></td>        
                    <td align="center" width="180px" style="font-size: 8pt;"><strong>Uraian Pekerjaan</strong></td>      
                    <td align="center" width="30px" style="font-size: 8pt;"><strong>Volume</strong></td>
                    <td align="center" width="30px" style="font-size: 8pt;"><strong>Satuan</strong></td>  
                    <td align="center" width="80px" style="font-size: 8pt;"><strong>Harga</strong></td>
                    <td align="center" width="80px" style="font-size: 8pt;"><strong>Total</strong></td>             
                </tr>  
            </thead>

             <?php
               $no =1; 
               foreach ($coba as $kp) {
                ?>
            <thead>
            <tr role="row" class="odd">
                                    <td align="center" style="font-size: 8pt;"><strong> <?= $no; ?></strong></td>
                                    <th style="font-size: 8pt;" colspan="5"><strong><?= $kp['nama_kategori'] ?></strong></th>
                                
                                    </tr>
                                    <!-- ini buat isi bua / detail ahs nya -->
                                    
                                   <?php
                                    foreach($detail_proyek_ahs as $da) { 
                                    if ($kp['id_pekerjaan'] == $da['id_pekerjaan']) {
                                      ?>
                                    <tr>
                                      <th align="center" style="font-size: 8pt;"></th>
                                      <th style="font-size: 8pt;"><?=$da['nm_ahs']; ?></th>
                                      <th style="font-size: 8pt;"><?=$da['volume']; ?></th>
                                      <th style="font-size: 8pt;"><?=$da['satuan']; ?></th>
                                      <th style="font-size: 8pt;">Rp. </th>
                                      <th style="font-size: 8pt;">Rp. </th>
                                    </tr>
                                    <!-- stop if-->
                                    <?php } ?>
                                     <!-- stop perulangan $da -->
                                    <?php } ?>  
                                   <?php foreach($detail_proyek_ahs as $da) { 
                                    if ($kp['id_pekerjaan'] == $da['id_pekerjaan']) {
                                      ?>
                                    <?php $jumlah = $this->db->select_sum('detail_proyek_ahs.subtotal')
                                          ->from('detail_proyek_ahs')
                                          ->join('ahs', 'detail_proyek_ahs.id_ahs = ahs.id_ahs', 'LEFT')
                                          ->where('detail_proyek_ahs.id_pekerjaan', $da['id_pekerjaan'])
                                          ->where('detail_proyek_ahs.id_proyek', $kp['id_proyek'])
                                          ->get()->row()->subtotal;
                                     ?>
                                    <tr role="row" class="odd">
                                    <td align="center" colspan="5" style="font-size: 8pt;">
                                        <strong>Jumlah</strong>
                                    </td>
                                    <th style="font-size: 8pt;">Rp.</th>
                                    </tr>
                                    <?php break; } ?>
                                    <?php } ?>
            </thead>
            <?php $no++; ?>
            <?php } ?> 

             <thead>
               <tr role="row" class="odd">
                                    <td align="center" colspan="5" style="font-size: 8pt;">
                                      <strong>
                                        Total Harga Proyek
                                      </strong>
                                    <th style="font-size: 8pt;">Rp.</th>
                                    
               </tr>
            </thead>
            <thead>
               <tr role="row" class="odd">
                                    <td align="center" colspan="5" style="font-size: 8pt;">
                                      <strong>
                                        Jasa Kontraktor  
                                      </strong>
                                    <th style="font-size: 8pt;">Rp.</th>
                                    
               </tr>
            </thead>
            <thead>
               <tr role="row" class="odd">
                                    <td align="center" colspan="5" style="font-size: 8pt;">
                                      <strong>
                                        Total Setelah Jasa Kontraktor
                                      </strong>
                                    <th style="font-size: 8pt;">Rp. </th>           
               </tr>
            </thead>
            </table>

        <br>

        <table class="table table-bordered table-striped">
          <thead>
                <tr>     
                    <td align="center" style="font-size: 8pt;"><strong>Approved</strong></td>  
                    <td align="center" style="font-size: 8pt;"><strong>Checked</strong></td>
                    <td align="center" style="font-size: 8pt;"><strong>Prepared</strong></td>             
                </tr>  
            </thead>
            <thead>
                        <tr role="row" class="odd">
                              <td align="center" rowspan="3"></td>
                              <td align="center" rowspan="3"></td>
                              <td align="center" rowspan="3"></td>
                        </tr>
                        <tr role="row" class="odd">
                        </tr>
                        <tr role="row" class="odd">
                        </tr>
                        <tr role="row" class="odd">
                          <td align="center" style="font-size: 8pt;"><strong><?= $proyek['approved']; ?></strong></td>
                          <td align="center" style="font-size: 8pt;"><strong><?= $proyek['checked']; ?></strong></td>
                          <td align="center" style="font-size: 8pt;"><strong><?= $proyek['prepared']; ?></strong></td>
                        </tr>
            </thead>
        </table>
    </body>
</html>