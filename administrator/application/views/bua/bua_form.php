<section class="content-header">
      <h1>
        RAB PT. ADM
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Bua</a></li>
        <li class="active"><?php echo $button ?> Bua</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Bua-->
		<legend><?php echo $button ?> Bua</legend>
        <form action="<?php echo $action; ?>" method="post">
		<input type="hidden" class="form-control" name="id_bua" id="id_bua" value="<?php echo $id_bua; ?>" />
	    <div class="form-group">
            <label for="varchar">Nama Bua <?php echo form_error('nama_bua') ?></label>
            <input type="text" class="form-control" name="nama_bua" id="nama_bua" placeholder="Nama Bua" value="<?php echo $nama_bua; ?>" />
            <label for="int"><?php echo form_error('id_kategori') ?></label>
                <?php 
                      echo combobox('id_kategori','kategori','nama_kategori','id_kategori', $id_kategori);
                ?>
        </div>	

		<div class="form-group">
            <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
        </div>

        <div class="form-group">
            <label for="varchar">Ukuran <?php echo form_error('ukuran') ?></label>
            <input type="text" class="form-control" name="ukuran" id="ukuran" placeholder="Ukuran" value="<?php echo $ukuran; ?>" />
        </div>	

        <div class="form-group">
            <label for="varchar">Spesifikasi <?php echo form_error('spesifikasi') ?></label>
            <input type="text" class="form-control" name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi" value="<?php echo $spesifikasi; ?>" />
        </div>	

        <div class="form-group">
            <label for="varchar">Merk <?php echo form_error('merk') ?></label>
            <input type="text" class="form-control" name="merk" id="merk" placeholder="Merk" value="<?php echo $merk; ?>" />
        </div>

        <div class="form-group">
            <label for="varchar">Warna <?php echo form_error('warna') ?></label>
            <input type="text" class="form-control" name="warna" id="warna" placeholder="Warna" value="<?php echo $warna; ?>" />
        </div>

        <div class="form-group">
            <label for="varchar">Harga <?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
				
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bua') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
