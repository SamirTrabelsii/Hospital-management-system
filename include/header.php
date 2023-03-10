<?php error_reporting(0);?>
<header class="navbar navbar-default navbar-static-top">
					<!-- start: NAVBAR HEADER -->
					<div class="navbar-header">
						<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
							<i class="ti-align-justify"></i>
						</a>
						<a class="navbar-brand margin-top-10" href="#">
							<h2 style="padding-top:2% ">Navigation</h2>
						</a>
						<a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
							<i class="ti-align-justify"></i>
						</a>
						<a class="pull-right menu-toggler visible-xs-block " id="menu-toggler" data-toggle="collapse" href="#navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<i class="ti-view-grid"></i>
						</a>
					</div>
					<!-- end: NAVBAR HEADER -->
					<!-- start: NAVBAR COLLAPSE -->
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-right">
							<!-- start: MESSAGES DROPDOWN -->
								<li  style="padding-top:2% ">
								<h2>Cabinet Médical YOANA .</h2>
							</li>
							<li class="">
								<img src="assets/images/logo.png" alt="Peter" style="  width: 69px;
  height: 39px;
  border-radius: 50%;
  overflow: hidden;
  margin-top: 4px;">

					
							</li>
						
							<li class="dropdown current-user">
								<a href="index.php?controller=Personel&action=logout">
									Log Out
								</a>
							</li>

							<!-- <li class="dropdown current-user">
								<a href class="dropdown-toggle" data-toggle="dropdown">
									<img src="assets/images/avatar-1.jpg" alt="Peter"> <span class="username">
										<?php echo $_SESSION['idPers']?>
									<i class="ti-angle-down"></i></i></span>
								</a>
								<ul class="dropdown-menu dropdown-dark">
									<li>
										<a href="index.php?controller=Personel&action=logout">
											Log Out
										</a>
									</li>
								</ul>
							</li> -->
							<!-- end: USER OPTIONS DROPDOWN -->
						</ul>
						<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
					</div>
				
					
					<!-- end: NAVBAR COLLAPSE -->
				</header>
