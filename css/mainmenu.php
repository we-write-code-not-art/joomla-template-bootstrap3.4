<?php
$isMainMenuFluid = $params->get('fluidMainMenu');
?>

<?php if(!$this->params->get('mainmenuHasRoundedCorners')) : ?>
	.navbar-mainmenu {
		border-radius: 0 !important;
	}

	.navbar-mainmenu .navbar-nav > li > a {
		border-radius: 0 !important;
	}
<?php endif; ?>
