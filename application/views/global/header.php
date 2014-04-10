<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>SIMON PENSEM | Dashboard</title>

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
	<script type="text/javascript">
		$(function() {
			updatedata();
			setInterval(function(){updatedata();},900000);
		});

		function updatedata(){
			$.ajax({
				type 	: 'POST',
				dataType: 'json',
				url 	: '<?php echo base_url(); ?>dashboard/data/check',
				data 	: '',
				success : function(response) {
					if (response.count != '') {
						var alarm = document.getElementById("alarm_warning"); 
						var msg = 'Ada <strong>' + response.count + '</strong> pemasangan sementara yang perlu dibongkar. <br /> <ul>';
						$.each(response.data, function(i, ret){
							msg += '<li><a href="<?php echo base_url(); ?>dashboard/data/edit/' + ret.id + '">' + ret.nama_pemohon + '[' + ret.jadwal_bongkar + ']</a></li>';
						});
						msg += '</ul>';
						alarm.play();
						$('#message_warning').html(msg);
						$('#message_warning_wrap').show();
					} else {
						$('#message_warning_wrap').hide();
					}
				}
			});
		}
	</script>
	
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
				<a href="<?php echo base_url() . 'dashboard'; ?>">
					<i class="entypo-gauge"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<li <?php echo ($this->uri->segment(2) == 'data') ? "class='active'" : "" ; ?>>
				<a href="<?php echo base_url() . 'dashboard/data'; ?>">
					<i class="entypo-window"></i>
					<span>Data Pemasangan Sementara</span>
				</a>
			</li>

			<li <?php echo ($this->uri->segment(2) == 'laporan') ? "class='active opened'" : "" ; ?>>
				<a href="<?php echo base_url() . 'dashboard/laporan'; ?>">
					<i class="entypo-chart-bar"></i>
					<span>Laporan</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url() . 'dashboard/laporan/bulanan'; ?>">
							<i class="entypo-folder"></i>
							<span>Bulanan</span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url() . 'dashboard/laporan/tahunan'; ?>">
							<i class="entypo-archive"></i>
							<span>Tahunan</span>
						</a>
					</li>
				</ul>
			</li>

			<li <?php echo ($this->uri->segment(2) == 'admin' || $this->uri->segment(2) == 'pegawai' || $this->uri->segment(2) == 'guest') ? "class='active opened'" : "" ; ?>>
				<a href="ui-panels.html">
					<i class="entypo-newspaper"></i>
					<span>Pengaturan</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url() . 'dashboard/pegawai'; ?>">
							<i class="entypo-user"></i>
							<span>Pegawai</span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url() . 'dashboard/admin'; ?>">
							<i class="entypo-users"></i>
							<span>Administrator</span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url() . 'dashboard/guest'; ?>">
							<i class="entypo-users"></i>
							<span>Guest</span>
						</a>
					</li>
				</ul>
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
				<a href="<?php echo base_url() . 'dashboard/logout'; ?>">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
		
	</div>
	
</div>

<hr />

<div class="row" id="message_warning_wrap" style="display: none;">
	<div class="alert alert-danger" id="message_warning"></div>
</div>

<audio src="<?php echo base_url(); ?>assets/audio/alarm.mp3" type="audio/mpeg" id="alarm_warning"></audio>