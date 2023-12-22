<section class="content-header">
      <h1>
        RAB PT. ADM AHS
        <small>code your life with your oke</small>
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Bua-->
		<legend>Rincian Proyek</legend>
        
		
	    <div class="form-group">
            <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Nama Ahs" value="<?= $proyek['project_name']; ?>" readonly />
        </div>	
      <div class="form-group">
         <a href="#" class="btn btn-primary mb-3" <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKategoriModal"><i class="fa fa-plus-circle"></i> Kategori Pekerjaan</a> <!--class klo button kodenya btn btn-primary agar warnanya biru, mb-3(margin bottom 3), nama data target harus sama dengan id yang ada di modal di bawah tuh ada-->
      </div>
        <div class="form-group">
            <label for="varchar">Rincian Data AHS <?php echo form_error('ukuran') ?> </label>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="20px">No</th>		    
					          <th>Uraian Pekerjaan</th>		   
					          <th width="40px">Volume</th>
                    <th width="40px">Satuan</th>  
                    <th>Harga</th>
                    <th>Total</th>             
					          <th width="100px">Action</th>
                </tr>  
            </thead>
            
            <!-- pake cara baru -->
            
             <?php
               $no =1; 
               foreach ($coba as $kp) {
                ?>
             <thead>
            <tr role="row" class="odd">
                                    <td align="center"><strong> <?= $no; ?></strong></td>
                                    <td colspan="5">
                                        <strong>
                                         <?= $kp['nama_kategori'] ?>
                                        </strong>
                                    </td>
                                    <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('proyek/ambil_proyek/'). $proyek['id_proyek'] .'/'. $kp['id_pekerjaan']; ?>" <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                          </button>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                       <a onclick="javascript: return confirm('Yakin ingin hapus?')" href="<?= base_url('proyek/delete_kategori/'). $proyek['id_proyek'] .'/'. $kp['id_pekerjaan']; ?>" <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- ini buat isi bua / detail ahs nya -->                                   
                                    <?php
                                    foreach($detail_proyek_ahs as $da) { 
                                    if ($kp['id_pekerjaan'] == $da['id_pekerjaan']) {
                                      ?>
                                    <tr>
                                      <td align="center"></td>
                                      <td><?=$da['nm_ahs']; ?></td>
                                      <td><?=$da['volume']; ?></td>
                                      <td><?=$da['satuan']; ?></td>
                                      <td>Rp. <?=$da['total']; ?></td>
                                      <td>Rp. <?=$da['subtotal']; ?></td>
                                      <td>
                                        <div class="btn-group">
                                        <!-- ini buat Edit Detail AHS Proyek -->
                                         <a href="<?= base_url('proyek/form_edit_ahs/'). $da['id_proyek'].'/'.$da['id_pekerjaan'].'/'.$da['id_ahs']; ?>" <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                       </div>
                                       <div class="btn-group">
                                         <a onclick="javascript: return confirm('Yakin ingin hapus?')" href="<?= base_url('proyek/delete/'). $da['id_ahs'].'/'.$da['id_proyek'].'/'.$da['id_pekerjaan']; ?>" <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a> <!--class ini dpt getboostrap cari aja pils-->
                                      </div>
                                      </td>
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
                                    <td colspan="5" align="center"><strong>Jumlah</strong></td>
                                    <td align="left">Rp. <?= $jumlah ?> </td>
                                    <td align="center">
                                    </td>
                                    </tr>
                                    <?php break; } ?>
                                    <?php } ?>
                                    
            </thead>
            <?php $no++; ?>
            <?php } ?> 

            

          <form action="<?= base_url('proyek/update_total_proyek'); ?>" method="post">
               <tr>
                <td colspan="5" align="center"><strong>Total Harga Proyek</strong></td>
                <td> <label  />Rp. <?= $sum; ?></td>
                 <input type="hidden" class="form-control" name="total" id="total" value="<?= $sum; ?>"/>
                <td></td>
               </tr>
               <tr>
                <td colspan="5" align="center"><strong>Jasa Kontraktor</strong></td>
                <td> <label />Rp. <?= $kt; ?></td>
                <input type="hidden" class="form-control" name="kontraktor" id="kontraktor" value="<?= $kt; ?>"/>
                <td></td>
               </tr>
               <tr>
                <?php $hasil = $sum + $kt; ?>
                <td colspan="5" align="center"><strong>Total Setelah Jasa Kontraktor</strong></td>
                <td><label>Rp. <?= $hasil; ?></label></td>
                <td></td>
               </tr>
            </table>
                </div>	


        <div class="form-group">
            <label for="varchar">Approved <?php echo form_error('approved') ?></label>
            <input type="text" class="form-control" name="approved" id="approved" value="<?= $proyek['approved']; ?>"/>
        </div>

        <div class="form-group">
            <label for="varchar">Checked <?php echo form_error('checked') ?></label>
            <input type="text" class="form-control" name="checked" id="checked" value="<?= $proyek['checked']; ?>"/>
        </div>

        <div class="form-group">
            <label for="varchar">Prepared <?php echo form_error('prepared') ?></label>
            <input type="text" class="form-control" name="prepared" id="prepared" value="<?= $proyek['prepared']; ?>"/>
        </div>
      
        <input type="hidden" class="form-control" name="id_proyek" id="id_proyek" value="<?= $proyek['id_proyek']; ?>" />
           <button type="submit" class="btn btn-primary">Simpan
           </button>
           <a href="<?php echo site_url('proyek') ?>" class="btn btn-default">Kembali</a>
      </form>

  <!-- modal -->
  <?= form_open_multipart('proyek/add_kategori_pekerjaan') ?>
  <div class="modal" id="addKategoriModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori Pekerjaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
         <input type="hidden" class="form-control" name="id_proyek" id="id_proyek" value="<?= $proyek['id_proyek']; ?>" />
            <label>Kategori Pekerjaan</label>
            <label><?php echo form_error('id_pekerjaan') ?></label>
                <?php 
                      echo combobox('id_pekerjaan','kategori_pekerjaan','nama_kategori','id_pekerjaan', $id_pekerjaan);
                ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
</form>

    </body>
</html>