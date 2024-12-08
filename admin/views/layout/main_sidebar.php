<div class="main-nav">
	<!-- Sidebar Logo -->
	<div class="logo-box">
		<a href="<?php echo $base_url ?>home" class="logo-dark">
			<img src="<?php echo $base_url ?>assets/images/logo-sm.png" class="logo-sm" alt="logo sm">
			<img src=" <?php echo $base_url ?>assets/images/logo-dark.png" class="logo-lg" alt="logo dark">
		</a>

		<a href="<?php echo $base_url ?>home" class="logo-light">
			<img src=" <?php echo $base_url ?>assets/images/logo-sm.png" class="logo-sm" alt="logo sm">
			<img src=" <?php echo $base_url ?>assets/images/logo-light.png" class="logo-lg" alt="logo light">
		</a>
	</div>

	<!-- Menu Toggle Button (sm-hover) -->
	<button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
		<iconify-icon icon="solar:hamburger-menu-broken" class="button-sm-hover-icon"></iconify-icon>
	</button>

	<div class="scrollbar" data-simplebar>

		<ul class="navbar-nav" id="navbar-nav">
		<li class="menu-title">Menu</li>

			<?php include_once ("menus/menu.php"); ?>
			<?php include_once ("menus/extra_show.php"); ?>
			
		</ul>
	</div>
</div>