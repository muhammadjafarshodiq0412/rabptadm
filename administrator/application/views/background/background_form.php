<section class="content-header">
      <h1>
        RAB PT. ADM
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Background</a></li>
        <li class="active"><?php echo $button ?> Background</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Background-->
		<legend><?php echo $button ?> Background</legend>	
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" class="form-control" name="id_background" id="id_background" value="<?php echo $id_background; ?>" />
		<input type="hidden" class="form-control" name="gambar" id="gambar"  value="<?php echo $gambar; ?>" />
	    <div class="form-group">
            <label for="varchar">Nama Background <?php echo form_error('nama_background') ?></label>
            <input type="text" class="form-control" name="nama_background" id="nama_background" placeholder="Nama Background" value="<?php echo $nama_background; ?>" />
        </div>	    
		<div class="form-group">
			<label for="varchar">Gambar <?php echo form_error('gambar') ?></label>
			<div>
				<p class='help-block'>Silahkan upload dengan ukuran 1350 x 758</p>
			<input type="file" name="gambar" id="gambar">							
			</div>
		</div>	
		
				
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('background') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
