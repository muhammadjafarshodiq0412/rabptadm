<section class="content-header">
      <h3 class="modal-title" id="exampleModalLabel">Tambah Rincian Data AHS</h3>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
    
    <!-- Tampil Data Bua -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Tambah Rincian Data AHS</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
       
  <!--  <input type="hidden" class="form-control" name="id_bua" id="id_bua" value="<?=$id_bua; ?>" /> -->
      <div class="form-group">
            <label for="varchar">Cari Rincian Data<?php echo form_error('nm_ahs') ?></label>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Ketikan Nama BUA" />
        </div>   

        <div class="table-wrapper-scroll-y my-custom-scrollbar1">
            <label for="varchar">Menampilkan Hasil Data <?php echo form_error('ukuran') ?></label>
            <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th width="20px">No</th>        
                    <th>Nama</th>      
                    <th>Satuan</th>  
                    <th>Harga Dasar</th>
                    <th>Merk</th>
                    <th>Spesifikasi</th>   
                    <th>Warna</th>    
                    <th>Aksi</th>        
                </tr>  
            </thead>
            <thead>
            <tbody>
    <form action="<?= base_url('ahs/add_selected_bua'); ?>" method="post" >
    <?php $i =1; ?> <!--ini buat angka -->
    <?php foreach ($bua as $key =>$a) : ?>
       <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?=$a['nama_bua']; ?></td>
      <td><?=$a['satuan']; ?></td> 
      <td><?=$a['harga']; ?></td>
      <td><?=$a['merk']; ?></td> 
      <td><?=$a['spesifikasi']; ?></td>
      <td><?=$a['warna']; ?></td>      
      <td>
          <input class="form-check-input position-static" type="checkbox" name="id_bua[]" id="id_bua[]" value="<?=$a['id_bua']; ?>" 
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
          <input type="hidden" class="form-control" name="id_ahs" id="id_ahs" value="<?= $ahs['id_ahs'] ?>" />
          <input type="hidden" class="form-control" name="id_kategori1" id="id_kategori1" value="<?= $kategori['id_kategori'] ?>" />
          <button type="submit" class="btn btn-primary">Add Selected</button> 
      </form>
        </td>
        <td>
          <a href="<?= base_url('ahs/after_create_ahs/'). $ahs['id_ahs'] ; ?>" <button type="button" class="btn btn-danger">Kembali</a>
        </td>
      </tr> 
       </div>
       </table>
 <!--Kode Script untuk Pencarian Data Otomatis dengan JavaScript-->
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

      <!--          <script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script> -->
    <!--// Tampil Data Bua -->