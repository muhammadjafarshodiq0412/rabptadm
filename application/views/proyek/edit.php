<section class="content-header">
      <h1>
        RAB PT. ADM
        <small>code your life with your oke</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Bua-->
		<legend>Edit Rincian Data AHS</legend>
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
	    <form action="<?= base_url('proyek/hitung_subtotal') ?>" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="nm_ahs" id="nm_ahs" value="<?= $ahs['nm_ahs']; ?>" readonly />
        </div>	

		<div class="form-group">
            <input type="text" class="form-control" name="total" id="total" value="<?= $ahs['total']; ?>" readonly />
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="volume" id="volume" placeholder="Volume" />
        </div>	
        
    
        <input type="hidden" class="form-control" name="id_pekerjaan" id="id_pekerjaan" value="<?= $kategori_pekerjaan['id_pekerjaan']; ?>" />
        <input type="hidden" class="form-control" name="id_proyek" id="id_proyek" value="<?= $proyek['id_proyek']; ?>" />
        <input type="hidden" class="form-control" name="id_ahs" id="id_ahs" value="<?= $ahs['id_ahs']; ?>" />
	      <button type="submit" class="btn btn-primary">Hitung & Simpan</button> 
        <a href="<?= base_url('proyek/after_create_proyek/').$proyek['id_proyek']; ?>" <button type="button" class="btn btn-danger">Kembali</a>
        </form>

    </body>
</html>