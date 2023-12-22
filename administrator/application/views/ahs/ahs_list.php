<section class="content-header">
      <h1>
        RAB PT. ADM
        <small>code your life with your AHS</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Tampil Data Bua -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Analisa Harga Satuan</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('ahs/create_ahs'), 'Create', 'class="btn btn-primary"'); ?> <br><br>
	    </div>
        </div>
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th width="80px">No</th>		    
					          <th>Nama AHS</th>
                    <th>Kategori Pekerjaan</th>
                    <th>Satuan</th>  
                    <th>Total AHS</th>		              
					          <th width="170px">Action</th>
                </tr>  
            </thead>
             <tbody>
    <?php $i =1; ?> <!--ini buat angka -->
    <?php foreach ($ahs as $key =>$a) : ?>
       <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?=$a['nm_ahs']; ?></td>
      <td><?=$a['nama_kategori']; ?></td>
      <td><?=$a['satuan']; ?></td>
      <td><?=$a['total']; ?></td>      
      <td>
        <a href="<?= base_url('ahs/after_create_ahs/'). $a['id_ahs']; ?>" <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i></a>
        <a href="<?= base_url('ahs/update/'). $a['id_ahs']; ?>" <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></a> <!--class ini dpt getboostrap cari aja pils & pilih yg links-->
        <a onclick="javascript: return confirm('Yakin ingin hapus?')" href="<?= base_url('ahs/delete/'). $a['id_ahs']; ?>" <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a> <!--class ini dpt getboostrap cari aja pils-->
      </td>
      
    </tr>
    <?php $i++; ?> <!-- ini buat penambahan angka-->
   <?php endforeach; ?>
      </tbody>      
	                 
            </table>
  </div>
        <!--Kode Script untuk Pencarian Data Otomatis dengan JavaScript-->
</script>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

                <script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
       
     


       
      



           
                                   
      
		<!--// Tampil Data Bua -->