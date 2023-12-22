<section class="content-header">
      <h1>
        RAB PT. ADM AHS
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Ahs</a></li>
        <li class="active"><?php echo $button ?> Ahs</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Bua-->
		<legend><?php echo $button ?> Ahs</legend>
        <form action="<?= base_url('ahs/add_ahs'); ?>" method="post">
		    <input type="hidden" class="form-control" name="id_ahs" id="id_ahs" value="<?php echo $id_ahs; ?>" />
	      <div class="form-group">
            <label for="varchar">Nama Analisa Harga Satuan <?php echo form_error('nm_ahs') ?></label>
            <input type="text" class="form-control" name="nm_ahs" id="nm_ahs" placeholder="Nama Ahs" value="<?php echo $nm_ahs; ?>" />
            <label for="int"><?php echo form_error('id_pekerjaan') ?></label>
                <?php 
                      echo combobox('id_pekerjaan','kategori_pekerjaan','nama_kategori','id_pekerjaan', $id_pekerjaan);
                ?>
        </div>					
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ahs') ?>" class="btn btn-default">Cancel</a>
	</form>

    </div>
  </div>
</div>
    </body>
</html>
