<section class="content-header">
      <h1>
        RAB PT. ADM
        <small>code your life with your Proyek</small>
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
                <h2 style="margin-top:0px">Proyek</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('proyek/create_proyek'), 'Create', 'class="btn btn-primary"'); ?> <br><br>
        </div>
        </div>
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th width="30px">No</th>		    
					          <th width="60px">Reg No</th>
                    <th width="200px">Project Name</th>
                    <th>Username</th>
                    <th>Dept</th>
                    <th>Create Date</th>
                    <th>Due Date</th>
                    <th>Status</th>		              
					          <th align="center" width="150px">Action</th>
                    <th>Print</th>
                </tr>  
            </thead>
             <tbody>
    <?php $i =1; ?> <!--ini buat angka -->
    <?php foreach ($proyek as $key =>$a) : ?>
       <tr>
      <th scope="row"><?= $i; ?></th>
      <td ><?=$a['id_proyek']; ?></td>
      <td><?= substr($a['project_name'], 0,36); ?>..</td>
      <td><?=$a['username']; ?></td>
      <td><?=$a['departement']; ?></td>
      <td><?=$a['create_date']; ?></td>
      <td><?=$a['due_date']; ?></td>
      <td><?=$a['status']; ?></td>      
      <td>
        <a href="<?= base_url('proyek/after_create_proyek/'). $a['id_proyek']; ?>" <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i></a>
        <a href="<?= base_url('proyek/update/'). $a['id_proyek']; ?>" <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></a> <!--class ini dpt getboostrap cari aja pils & pilih yg links-->
        <a onclick="javascript: return confirm('Yakin ingin hapus?')" href="<?= base_url('proyek/delete_proyek/'). $a['id_proyek']; ?>" <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a> <!--class ini dpt getboostrap cari aja pils-->
      </td>
      <td>
        <a href="<?= base_url('proyek/pdf/'). $a['id_proyek']; ?>" <button type="button" class="btn btn-warning">Cetak</a> <!--class ini dpt getboostrap cari aja pils & pilih yg links-->
        <a href="<?= base_url('proyek/pdf1/'). $a['id_proyek']; ?>" <button type="button" class="btn btn-danger">Cetak</a> <!--class ini dpt getboostrap cari aja pils & pilih yg links-->
      </td>
      
    </tr>
    <?php $i++; ?> <!-- ini buat penambahan angka-->
   <?php endforeach; ?>
      </tbody>      
	                 
            </table>
  </div>
          <!--Kode Script untuk Pencarian Data Otomatis dengan JavaScript-->
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

        <script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
       
     


       
      



           
                                   
      
		<!--// Tampil Data Bua -->