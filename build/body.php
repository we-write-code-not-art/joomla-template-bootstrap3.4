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

<?php if ($renderModules && $hasTopMenu) : ?>
    <?php $xsMenuSiteName1 = "";
    $topMenuBrandImage="/images/templates/remembering-photos/site/top-brand.png"; ?>
		<nav class="navbar navbar-topmenu hidden-xs <?php echo $topMenuFluid; ?>" >
			<!--div class="<?php echo $containerFluid; ?>"-->
				<div class="navbar-header">
					<a class="navbar-brand" href="/">
						<span><img alt="<?php echo $xsMenuSiteName1; ?>" height="40px" src="<?php print $topMenuBrandImage; ?>" /></span>
						<span><?php echo $xsMenuSiteName1; ?></span>
					</a>
				</div>
				<div class="pull-left">
					<jdoc:include type="modules" name="top" style="none" />
        </div>
			<!--/div-->
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

<?php if ($hasBreadcrumbs) : ?> 
		<div class="row">
			<div class="breadcrumbs hidden-xs col-lg-12">
				<jdoc:include type="modules" name="breadcrumbs" style="none" />
			</div>
		</div>
<?php endif; ?>
<?php if ($hasSearch) :?> 
		<div class="row">
			<div class="pull-right text-right col-lg-3" >
					<jdoc:include type="modules" name="search" style="none" />
			</div>
		</div>
<?php endif; ?>

<?php include "content.php"; ?>
	</div>
