	<div class="body-panel panel <?php echo $containerFluid; ?>">
<?php 
  if ($xsMenuHasBrandImage || $hasCollapsedMenu || $hasCollapsedProfileMenu || $hasCollapsedFooterMenu || $isLoggedIn) :
    include "menu-collapsed.php";  
  endif; 
?>

<?php if ($renderModules && $hasProfileMenu) : ?>
		<nav class="navbar navbar-user hidden-xs navbar-fixed-top">
			<div class="<?php echo $containerFluid; ?>">
<?php   if ($isLoggedIn) : ?>
				<div class="navbar-header">
					<a class="navbar-brand navbar-user-avatar" href="index.php/edit-profile">
						<span><img alt="<?php echo $user->name; ?>" src="<?php print $userPhoto; ?>" /></span>
						<span><?php echo $user->name; ?></span>
					</a>
				</div>
<?php   endif; ?>
				<div class="pull-right">
					<jdoc:include type="modules" name="profile" style="none" />
				</div>
			</div>
		</nav>
<?php endif; ?>
<?php 
  if ($showxsBannerAll) :
    include "banner-xs.php";
  endif; 
?>

<?php 
  if (!$bannerIsFluid) : 
    include "banner-static.php";
  endif; 
?>

<?php if (($isMainMenuFluid==0)  && ($hasMainMenu)) : ?>
		<nav class="navbar navbar-mainmenu hidden-xs <?php echo $mainMenuFluid; ?>">
			<jdoc:include type="modules" name="main-menu" style="none" />
		</nav>
<?php endif; ?>

<?php if ($hasSearch) :?> 
		<div class="row">
			<div class="pull-right text-right col-lg-3" >
					<jdoc:include type="modules" name="search" style="none" />
			</div>
		</div>
<?php endif; ?>

<?php include "content-error.php"; ?>
	</div>
