<section class="content-header">
      <h1>
        RAB PT. ADM
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Users</a></li>
        <li class="active"><?php echo $button ?> Users</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
			<!-- Form input atau edit Users -->
			<h2 style="margin-top:0px">Users <?php echo $button ?></h2>
			<form action="<?php echo $action; ?>" method="post">
				<input type="hidden" class="form-control" name="id_user" id="id_user" value="<?php echo $id_user; ?>" />
				<div class="form-group">
					<label for="varchar">Username <?php echo form_error('username') ?></label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Password <?php echo form_error('password') ?></label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password"  />
				</div>
				<div class="form-group">
					<label for="varchar">Email <?php echo form_error('email') ?></label>
					<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
				</div>	
				<div class="form-group">
					<label for="varchar">Level <?php echo form_error('level') ?></label>
					<input type="text" class="form-control" name="level" id="level" placeholder="Level" value="admin" readonly />
				</div>	

				
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
				<a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
			</form>
