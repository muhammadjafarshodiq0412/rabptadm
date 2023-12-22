<section class="content-header">
      <h1>
        RAB PT. ADM
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Informasi</a></li>
        <li class="active"><?php echo $button ?> Informasi</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Informasi-->
		<legend><?php echo $button ?> Informasi</legend>	
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" class="form-control" name="id_informasi" id="id_informasi" value="<?php echo $id_informasi; ?>" />
		<input type="hidden" class="form-control" name="gambar" id="gambar"  value="<?php echo $gambar; ?>" />
	    <div class="form-group">
            <label for="varchar">Nama Informasi <?php echo form_error('nama_informasi') ?></label>
            <input type="text" class="form-control" name="nama_informasi" id="nama_informasi" placeholder="Nama Informasi" value="<?php echo $nama_informasi; ?>" />
        </div>	    
		<div class="form-group">
			<label for="varchar">Gambar <?php echo form_error('gambar') ?></label>
			<div>
				<p class='help-block'>Silahkan upload dengan ukuran 1090 x 480</p>
			<input type="file" name="gambar" id="gambar">							
			</div>
		</div>	
		
				
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('informasi') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
