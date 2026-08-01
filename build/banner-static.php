		<header class="banner hidden-xs">
<?php if ($bannerParallaxImage!='') : ?>
			<div class="panel" data-parallax="scroll" data-z-index="1" data-speed="<?php echo $bannerParallaxSpeed; ?>" data-image-src="<?php echo $bannerParallaxImage; ?>">
<?php else: ?>
			<div class="panel">
<?php endif; ?>
				<div class="overlay"></div>
				<div class="panel-body">
        <div >
				<jdoc:include type="modules" name="banner" style="none" />












<?php
/*if($this->countModules('banner')>0) {*/

  $piwigo_url = 'https://gallery.remembering.photos/ws.php?format=json';
  $api_key = 'pkid-20260719-LZhFwScdOD2pto3Yl6LX:GSqOA0O44m1pzMBDvC3ec6XcVFzDTk7Be71ah31t'; 

  // 3. Prepare parameters to send inside the POST body
  $post_fields = [
      //'method'   => 'pwg.tags.getImages',
      //tag_id     => '7',
      'method'   => 'pwg.categories.getImages',
      //'cat_id'   => 0,        // 0 for your entire gallery, or input a private album ID
      'per_page' => 20,       // Max photos to fetch per rotation cycle
      'order'    => 'random'  // Keeps the array shuffled
  ];

  // 4. Fetch data from Piwigo using HTTP POST + Headers
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $piwigo_url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);

  // 5. Inject the custom X-PIWIGO-API header into the request
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'X-PIWIGO-API: ' . $api_key
  ]);

  $response = curl_exec($ch);
  curl_close($ch);

  // 6. Parse the JSON response exactly as before
  $data = json_decode($response, true);
  $images = [];

  if (isset($data['stat']) && $data['stat'] == 'ok' && !empty($data['result']['images'])) {
      $images = $data['result']['images'];
  }
/*}*/
?>

<div id="banner-carousel" class="carousel slide" data-ride="carousel" data-interval="5000"><!-- Indicators -->
  <!-- Carousel Indicators (Optional) -->
  <ol class="carousel-indicators">
    <?php foreach ($images as $index => $img): ?>
      <li data-target="#banner-carousel" data-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></li>
    <?php endforeach; ?>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php foreach ($images as $index => $img): ?>
      <div class="item <?php echo $index === 0 ? 'active' : ''; ?>">
        <!-- Use 'element_url' for full size or 'derivatives' array for resized variants -->
        <img src="<?php echo htmlspecialchars($img['element_url']); ?>" alt="<?php echo htmlspecialchars($img['name'] ?? ''); ?>" >
            
        <!-- Optional Text Caption -->
        <?php if (!empty($img['name']) || !empty($img['comment'])): ?>
          <div class="caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 5px;">
            <h5><?php echo htmlspecialchars($img['name']); ?></h5>
            <p><?php echo htmlspecialchars(strip_tags($img['comment'] ?? '')); ?></p>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

  </div>
</div>



















        </div>
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
