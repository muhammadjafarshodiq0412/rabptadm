<section class="content-header">
      <h3 class="modal-title" id="exampleModalLabel">Tambah Rincian Data Pekerjaan</h3>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
    
    <!-- Tampil Data Bua -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Tambah Rincian Data Pekerjaan</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
       
  <!--  <input type="hidden" class="form-control" name="id_bua" id="id_bua" value="<?=$id_bua; ?>" /> -->
      <div class="form-group">
            <label for="varchar">Cari Rincian Data<?php echo form_error('rincian_proyek') ?></label>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Ketikan Nama AHS" />
        </div>  

        <div class="table-wrapper-scroll-y my-custom-scrollbar1">
            <label for="varchar">Menampilkan Hasil Data</label>
            <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th width="80px">No</th>        
                    <th>Nama</th>   
                    <th>Satuan</th>   
                    <th>Harga</th>  
                    <th>Aksi</th>        
                </tr>  
            </thead>
            <thead>
            <tbody>
    <form action="<?= base_url('proyek/add_selected_ahs'); ?>" method="post" >
    <?php $i =1; ?> <!--ini buat angka -->
    <?php foreach ($ahs as $key =>$ah) : ?>
       <tr> 
      <th scope="row"><?= $i; ?></th>
      <td><?=$ah['nm_ahs']; ?></td>
      <td><?=$ah['satuan']; ?></td>
      <td><?=$ah['total']; ?></td> 
      <td>
          <input class="form-check-input position-static" type="checkbox" name="id_ahs[]" id="id_ahs[]" value="<?=$ah['id_ahs']; ?>" 
      aria-label="...">     
      </td> 
      </tr>
    <?php $i++; ?> <!-- ini buat penambahan angka-->
    <?php endforeach; ?>
      </tbody>                        
            </thead>               
         </table>
     </div> 
     <table>
      <div class="form-group">  
      <tr>
        <td>
          <input type="hidden" class="form-control" name="id_proyek" id="id_proyek" value="<?= $proyek['id_proyek'] ?>" />
          <input type="hidden" class="form-control" name="id_pekerjaan" id="id_pekerjaan" value="<?= $pekerjaan['id_pekerjaan'] ?>" />
      <button type="submit" class="btn btn-primary">Add Selected</button> 
       <a href="<?= base_url('proyek/after_create_proyek/'). $proyek['id_proyek'] ; ?>" <button type="button" class="btn btn-danger">Kembali</a>
      </form>
        </td>
      </tr> 
       </div>
       </table>
      
       <div class="table-wrapper-scroll-y my-custom-scrollbar1">
            <label for="varchar">Menampilkan Hasil Data <?php echo form_error('ukuran') ?></label>
              <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>        
                    <th>Nama AHS</th>      
                    <th>Volume</th>
                    <th>Satuan</th>  
                    <th>Harga</th>
                    <th>Total</th>  
                <!--    <th>Aksi</th>  -->      
                </tr>  
            </thead>
            <thead>
            <tbody>
    
    <?php $i =1; ?> <!--ini buat angka -->
    <?php foreach ($detail_proyek_ahs as $key =>$a) : ?>
       <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?=$a['nm_ahs']; ?></td>
      <td><?=$a['volume']; ?></td> 
      <td><?=$a['satuan']; ?></td>
      <td><?=$a['total']; ?></td> 
      <td><?=$a['subtotal']; ?></td>  
    <!--  <td>
        <a href="<?= base_url('proyek/form_edit_ahs/'). $a['id_proyek'].'/'.$a['id_pekerjaan'].'/'.$a['id_ahs']; ?>" <button type="button" class="btn btn-primary">Add Volume</a>
      </td>  -->
      </tr>
    <?php $i++; ?> <!-- ini buat penambahan angka-->
    <?php endforeach; ?>
      </tbody>                        
        </thead>  
          </table>
    </div>
        <!-- <input type="text" class="form-control" name="harga" id="harga" value="<?= $hasil ; ?>" /> -->


      <div class="modal-footer">
             <a href="<?= base_url('proyek/after_create_proyek/'). $proyek['id_proyek']; ?>" <button type="button" class="btn btn-success">Selesai & Simpan</a>
     </div>

   <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
       
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>        
    <!--// Tampil Data Bua -->