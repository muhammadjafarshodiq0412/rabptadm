<?php
	ini_set('display_errors', '0');
    ini_set('error_reporting', E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RAB PT. ADM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/_all-skins.min.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('admin') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>RAB</b>PT. ADM</span>
      <span class="logo-lg"><b>RAB PT. ADM</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $username; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <p>
                  <?php echo $username; ?> - <?php echo $rab; ?>
                  <small><?php echo $rab; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#"><?php echo $level; ?></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"><?php echo $email; ?></a>
                  </div>
                  
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('users') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('admin/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         <br />
		<?php
            // Data main menu
            $main_menu = $this->db->get_where('menu', array('main_menu' => 0));
            foreach ($main_menu->result() as $main) {
                // Query untuk mencari data sub menu
                $sub_menu = $this->db->get_where('menu', array('main_menu' => $main->id_menu));
                // Memeriksa apakah ada sub menu, jika ada sub menu tampilkan
                if ($sub_menu->num_rows() > 0) {
					if ($main->id_menu > 0) {
						// Main menu yang memiliki sub menu
						echo "<li class='treeview'>" . anchor($main->link, '<i class="' . $main->icon . '"></i>' . $main->nama_menu .
								'<span class="pull-right-container">
							  <i class="fa fa-angle-left pull-right"></i>
							  </span>');
						// Menampilkan data sub menu
						echo "<ul class='treeview-menu'>";
						foreach ($sub_menu->result() as $sub) {
									echo "<li>" . anchor($sub->link, '<i class="' . $sub->icon . '"></i>' . $sub->nama_menu) . "</li>";
								}
						echo"</ul>
							 </li>";
					}	 
                } 
				// Jika tidak memiliki sub menu maka tampilkan data main menu
				else {
					if ($main->id_menu > 0) {
                        // Data main menu tanpa sub menu
                        echo "<li>" . anchor($main->link, '<i class="' . $main->icon . '"></i>' . $main->nama_menu) . "</li>";
					}
				}
            }
        ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HII..
		<?php
			echo strtoupper($username); 
		?>
		SELAMAT DATANG DI RAB
		<?php		
			echo strtoupper($rab);				
		?>		        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">               
          <div class="box box-default color-palette-box">
			<div class="box-header with-border">
			  <h3 class="box-title"><i class="fa fa-gears"></i> Control Panel</h3>
			</div>

			<div class="box-body">
			  <div class="row">
				
        <!-- /.col -->
        <div class="col-sm-4 col-md-2">
          <h4 class="text-center"><span class="info-box-text">BUA</span></h4>
          <div class="color-palette-set">
          <a href="<?php echo site_url('bua') ?>"><center><i class="fa fa-server" style="font-size:48px;color:#3c8dbc"></i><center></a> 
          </div>
        </div>
        <!-- /.col -->
			  <!-- /.col -->
        <div class="col-sm-4 col-md-2">
          <h4 class="text-center"><span class="info-box-text">AHS</span></h4>
          <div class="color-palette-set">
          <a href="<?php echo site_url('ahs') ?>"><center><i class="fa fa-server" style="font-size:48px;color:#3c8dbc"></i><center></a> 
          </div>
        </div>
         <!-- /.col -->
        <div class="col-sm-4 col-md-2">
          <h4 class="text-center"><span class="info-box-text">User</span></h4>
          <div class="color-palette-set">
          <a href="<?php echo site_url('user') ?>"><center><i class="fa fa-server" style="font-size:48px;color:#3c8dbc"></i><center></a> 
          </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 col-md-2">
          <h4 class="text-center"><span class="info-box-text">Kategori Pekerjaan</span></h4>
          <div class="color-palette-set">
          <a href="<?php echo site_url('kategori_pekerjaan') ?>"><center><i class="fa fa-server" style="font-size:48px;color:#3c8dbc"></i><center></a> 
          </div>
        </div>
         <!-- /.col -->
        <div class="col-sm-4 col-md-2">
          <h4 class="text-center"><span class="info-box-text">Informasi</span></h4>
          <div class="color-palette-set">
          <a href="<?php echo site_url('informasi') ?>"><center><i class="fa fa-server" style="font-size:48px;color:#3c8dbc"></i><center></a> 
          </div>
        </div>
          <!-- /.col -->
        <div class="col-sm-4 col-md-2">
          <h4 class="text-center"><span class="info-box-text">Background</span></h4>
          <div class="color-palette-set">
          <a href="<?php echo site_url('background') ?>"><center><i class="fa fa-server" style="font-size:48px;color:#3c8dbc"></i><center></a> 
          </div>
        </div>

        
        </div>
			  <br /><br />
			  
			</div>
			<!-- /.box-body -->
		  </div>        
        <!-- /.box-body -->
        <div class="box-footer">
         <center><a href=""><strong>RAB PT. ADM</strong></a> - 2019</center>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>&copy; <a href="">Created By PT. ADM 2019</a>.</strong>
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/js/demo.js')?>"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
