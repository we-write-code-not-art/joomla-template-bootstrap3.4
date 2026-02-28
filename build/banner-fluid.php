		<header class="banner hidden-xs" >
<?php   if ($bannerParallaxImage!='') : ?>
			<div class="panel" data-parallax="scroll"  data-speed="<?php echo $bannerParallaxSpeed; ?>" data-image-src="<?php echo $bannerParallaxImage; ?>">
<?php   else: ?>
			<div class="panel">
<?php   endif; ?>
				<div class="overlay"></div>
				<div class="panel-body">
							<div class="media">
<?php   if ($bannerLogoImage!='' && $bannerLogoPlacement=="media-left") : ?>
								<div class="<?php echo $bannerLogoPlacement; ?>">
									<img id="banner-logo-img" class="media-object" src="<?php echo $bannerLogoImage; ?>" alt="<?php echo $siteName; ?>" />
								</div>
<?php   endif; ?>
								<div class="media-body">
<?php   if ($bannerShowSiteName) : ?>
									<h1 class="media-heading <?php echo $bannerSiteNameHorizontalAlignment; ?>"><?php echo $bannerSiteName; ?></h1> 
<?php   endif; ?>
<?php   if ($bannerShowSiteDescription) : ?>
									<p class="text-justify"><?php echo $bannerSiteDescription; ?></p> 
<?php   endif; ?>
								</div>
<?php   if ($bannerLogoImage!='' && $bannerLogoPlacement=="media-right") : ?>
								<div class="<?php echo $bannerLogoPlacement; ?>">
									<img id="banner-logo-img" class="media-object" src="<?php echo $bannerLogoImage; ?>" alt="<?php echo $siteName; ?>" />
								</div>
<?php   endif; ?>
							</div>
				</div>
			</div>
		</header>
