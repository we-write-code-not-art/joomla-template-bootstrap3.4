		<header class="banner-xs visible-xs-block">
<?php if ($showxsBanner) : ?>
			<div class="panel">
				<div class="panel-body">
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
