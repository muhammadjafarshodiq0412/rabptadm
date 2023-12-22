<section class="content-header">
      <h1>
        RAB PT. ADM
        <small>code your life with your style</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">User</a></li>
        <li class="active"><?php echo $button ?> User</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
			<!-- Form input atau edit Users -->
			<h2 style="margin-top:0px">User <?php echo $button ?></h2>
			<form action="<?php echo $action; ?>" method="post">
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
					<label for="enum">Departement <?php echo form_error('departement') ?></label>
					<select name="departement" class="form-control select2" style="width: 100%;">		
							<option value="GA Ops3">GA Ops3</option>
							<option value="External Affairs">External Affairs</option>
							<option value="Procurement">Procurement</option>
							<option value="HSE Corporate">HSE Corporate</option>
					</select>            
				</div>
				<div class="form-group">
					<label for="varchar">Ext <?php echo form_error('ext') ?></label>
					<input type="text" class="form-control" name="ext" id="ext" placeholder="Ext" value="<?php echo $ext; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Plant Name <?php echo form_error('plant_name') ?></label>
					<input type="text" class="form-control" name="plant_name" id="plant_name" placeholder="Plant Name" value="<?php echo $plant_name; ?>" />
				</div>
				<div class="form-group">
					<label for="enum">Level <?php echo form_error('level') ?></label>
					<select name="level" class="form-control select2" style="width: 100%;">		
							<option value="user1">User1</option>
							<option value="user2">User2</option>
					</select>            
				</div>
				
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
				<a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
			</form>
    