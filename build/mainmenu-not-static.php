<?php if ($renderModules && ($isMainMenuFluid==1 && $hasMainMenu)) : ?>
		<nav class="navbar navbar-mainmenu hidden-xs <?php echo $mainMenuFluid; ?>">
			<jdoc:include type="modules" name="main-menu" style="none" />
		</nav>
<?php endif; ?>

<?php if ($renderModules && ($isMainMenuFluid==2 && $hasMainMenu)) : ?>
		<nav class="navbar navbar-mainmenu hidden-xs <?php echo $mainMenuFluid; ?>">
			<div class="container"><jdoc:include type="modules" name="main-menu" style="none" /></div>
		</nav>
<?php endif; ?>
