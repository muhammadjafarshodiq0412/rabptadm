<section class="content-header">
      <h1>
        RAB PT. ADM
        <small>code your life with your oke</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Proyek</a></li>
        <li class="active"><?php echo $button ?> Proyek</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Bua-->
		<legend><?php echo $button ?> Proyek</legend>
        <form action="<?= base_url('proyek/update_action'); ?>" method="post">
		<input type="hidden" class="form-control" name="id_proyek" id="id_proyek" value="<?php echo $id_proyek; ?>" />
      <div class="form-group">
            <label for="varchar">Project Name <?php echo form_error('project_name') ?></label>
            <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Project Name" value="<?php echo $project_name; ?>" />
      </div>		
      <div class="form-group">
            <label for="varchar">Due Date <?php echo form_error('due_date') ?></label>
            <input type="date" class="form-control" name="due_date" id="due_date" value="<?php echo $due_date; ?>" />
      </div>
        <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
          <?php 
            $pilihan = array("" => "-- Pilihan --","open" => "open", "close" => "close");
            echo form_dropdown('status', $pilihan,$status, 'class="form-control" id="status"'); 
            echo form_error('status'); 
          ?>                
        </div> 			
	    <button type="submit" class="btn btn-primary">Create</button> 
	    <a href="<?php echo site_url('proyek') ?>" class="btn btn-default">Cancel</a>
	</form>

    </div>
  </div>
</div>
    </body>
</html>