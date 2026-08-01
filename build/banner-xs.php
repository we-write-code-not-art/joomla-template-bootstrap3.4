		<header class="banner-xs visible-xs-block">
<?php if ($showxsBanner) : ?>
			<div class="panel">
				<div class="panel-body">        
        <div class="piwigo_image">
        
          <div class="item">
            <img src="<?php echo htmlspecialchars($xsBannerPiwigoImage); ?>" alt="<?php echo htmlspecialchars($xsBannerPiwigoImageName ?? ''); ?>" >
                
            <!-- Optional Text Caption -->
            <?php if (!empty($xsBannerPiwigoImageName) || !empty($xsBannerPiwigoImageComment)): ?>
              <div class="caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 5px;">
                <h5><?php echo htmlspecialchars($xsBannerPiwigoImageName); ?></h5>
                <p><?php echo htmlspecialchars(strip_tags($xsBannerPiwigoImageComment ?? '')); ?></p>
              </div>
            <?php endif; ?>
          </div>
        
        </div>
					<div class="row">
						<div class="col col-xs-12"<?= $xsBannerFixedHeight !== '' ? ' style="height: '.$xsBannerFixedHeight.';"' : '' ?>>

						<div class="media">
						<div class="media-body">
<?php if ($xsBannerShowSiteName) : ?>
							<h1 class="media-heading <?php echo $xsBannerSiteNameAlignment; ?>"><?php echo $xsBannerSiteName; ?></h1> 
<?php endif; ?>
<?php if ($xsBannerShowSiteDescription) : ?>
							<p class="text-justify"><?php echo $xsBannerSiteDescription; ?></p> 
<?php endif; ?>
						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
<?php endif; ?>
		</header>
