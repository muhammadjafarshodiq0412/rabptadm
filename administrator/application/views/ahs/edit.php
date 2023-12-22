<section class="content-header">
      <h1>
        RAB PT. ADM
        
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
	    <form action="<?= base_url('ahs/hitung_subtotal') ?>" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="nama_bua" id="nama_bua" value="<?= $bua['nama_bua']; ?>" readonly />
        </div>	

		<div class="form-group">
            <input type="text" class="form-control" name="harga" id="harga" value="<?= $bua['harga']; ?>" readonly />
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="koefisien" id="koefisien" placeholder="Koefision" />
        </div>	
        
        <input type="hidden" class="form-control" name="id_kategori" id="id_kategori" value="<?= $kategori['id_kategori']; ?>" />
        <input type="hidden" class="form-control" name="id_ahs" id="id_ahs" value="<?= $ahs['id_ahs']; ?>" />
        <input type="hidden" class="form-control" name="id_bua" id="id_bua" value="<?= $bua['id_bua']; ?>" />
	    <button type="submit" class="btn btn-primary">Hitung & Simpan</button> 
         <a href="<?= base_url('ahs/after_create_ahs/').$ahs['id_ahs']; ?>" <button type="button" class="btn btn-danger">Kembali</a>
        </form>

    </body>
</html>
