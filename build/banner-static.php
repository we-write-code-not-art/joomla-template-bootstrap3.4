		<header class="banner hidden-xs">
<?php if ($bannerParallaxImage!='') : ?>
			<div class="panel" data-parallax="scroll" data-z-index="1" data-speed="<?php echo $bannerParallaxSpeed; ?>" data-image-src="<?php echo $bannerParallaxImage; ?>">
<?php else: ?>
			<div class="panel">
<?php endif; ?>
				<div class="overlay"></div>
				<div class="panel-body">
					<div class="row">
<?php if($renderModules && $hasBannerHeader): ?>      
            <div class="col col-lg-12">
              <jdoc:include type="modules" name="banner-header" style="none" />
            </div>
<?php endif; ?>            
						<div class="col col-lg-12">
							<div class="media">
<?php if ($bannerLogoImage!='' && $bannerLogoPlacement=="media-left") : ?>
								<div class="<?php echo $bannerLogoPlacement; ?>">
									<img id="banner-logo-img" class="media-object" src="<?php echo $bannerLogoImage; ?>" alt="<?php echo $siteName; ?>" />
								</div>
<?php endif; ?>
								<div class="media-body">
<?php if ($bannerShowSiteName) : ?>
									<h1 class="media-heading <?php echo $bannerSiteNameHorizontalAlignment; ?>"><?php echo $bannerSiteName; ?></h1> 
<?php endif; ?>
<?php if ($bannerShowSiteDescription) : ?>
									<p class="text-justify"><?php echo $bannerSiteDescription; ?></p> 
<?php endif; ?>
								</div>
<?php if ($bannerLogoImage!='' && $bannerLogoPlacement=="media-right") : ?>
								<div class="<?php echo $bannerLogoPlacement; ?>">
									<img id="banner-logo-img" class="media-object" src="<?php echo $bannerLogoImage; ?>" alt="<?php echo $siteName; ?>" />
								</div>
<?php endif; ?>
							</div>
						</div>
<?php if($renderModules && $hasBannerFooter): ?>
            <div class="col col-lg-12">
              <jdoc:include type="modules" name="banner-footer" style="none" />
            </div>
<?php endif; ?>            
					</div>
				</div>
			</div>
		</header>
