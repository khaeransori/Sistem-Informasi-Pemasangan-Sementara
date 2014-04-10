<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>SIMON PENSEM | Guest Dashboard</title>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/animation.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

	<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
</head>
<body class="page-body  page-left-in">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
	<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="<?php echo base_url(); ?>">
					<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" height="50px" />
				</a>
			</div>
			
						<!-- logo collapse icon -->
						
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
									
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
		</header>
				
		
				
		<ul id="main-menu" class="">

			<li <?php echo ($this->uri->segment(2) == '') ? "class='active'" : "" ; ?>>
				<a href="<?php echo base_url() . 'guest'; ?>">
					<i class="entypo-window"></i>
					<span>Data Pemasangan Sementara</span>
				</a>
			</li>
		</ul>
				
				
	</div>	
	<div class="main-content">
		
<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
			<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo base_url(); ?>assets/images/thumb-1.png" alt="" class="img-circle" />
					<?php echo $this->session->userdata('SESS_NAMA_USER'); ?>
				</a>
			</li>
		
		</ul>
	
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			<li>
				<a href="<?php echo base_url() . 'guest/logout'; ?>">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
		
	</div>
	
</div>

<hr />