<section class="content-header">
      <h1>
        RAB PT. ADM
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Kategori Pekerjaan</a></li>
        <li class="active"><?php echo $button ?> Kategori Pekerjaan</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
			<!-- Form input atau edit Kategori Pekerjaans -->
			<h2 style="margin-top:0px">Kategori Pekerjaan <?php echo $button ?></h2>
			<form action="<?php echo $action; ?>" method="post">
				<input type="hidden" class="form-control" name="id_pekerjaan" id="id_pekerjaan" value="<?php echo $id_pekerjaan; ?>" />
				<div class="form-group">
					<label for="varchar">Kategori Pekerjaan <?php echo form_error('nama_kategori') ?></label>
					<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori" value="<?php echo $nama_kategori; ?>" />
				</div>
				
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
				<a href="<?php echo site_url('kategori_pekerjaan') ?>" class="btn btn-default">Cancel</a>
			</form>
