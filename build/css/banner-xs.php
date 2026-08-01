<?php
use Joomla\CMS\Uri\Uri;

if($this->error) {
  $xsBannerBackgroundImage = $this->params->get('xsErrorBannerBackgroundImage')==""?"":(Uri::root().$this->params->get('xsErrorBannerBackgroundImage'));

  $xsBannerBackgroundImageRepeat = $this->params->get('xsErrorBannerBackgroundImageRepeat');

  $xsBannerBackgroundImagePositionX = $this->params->get('xsErrorBannerBackgroundImagePositionX');
  $xsBannerBackgroundImagePositionY = $this->params->get('xsErrorBannerBackgroundImagePositionY');
  $xsBannerBackgroundImageSizeType = $this->params->get('xsErrorBannerBackgroundImageSize');

  $xsBannerBackgroundImagePositionX = $xsBannerBackgroundImagePositionX=="value"?$this->params->get('xsErrorBannerBackgroundImagePositionXValue'):$xsBannerBackgroundImagePositionX;
  $xsBannerBackgroundImagePositionY = $xsBannerBackgroundImagePositionY=="value"?$this->params->get('xsErrorBannerBackgroundImagePositionYValue'):$xsBannerBackgroundImagePositionY;
  $xsBannerBackgroundImageSize = $xsBannerBackgroundImageSizeType=="value"?$this->params->get('xsErrorBannerBackgroundImageSizeValue'):($xsBannerBackgroundImageSizeType=="fixed"?"":($xsBannerBackgroundImageSizeType=="fill"?"100% 100%":""));

  $xsBannerPaddingTop = $this->params->get('xsErrorBannerPaddingTop');
  $xsBannerPaddingBottom = $this->params->get('xsErrorBannerPaddingBottom');

  $xsBannerTextPaddingTop = $this->params->get('xsErrorBannerTextPaddingTop');
  $xsBannerTextPaddingLeft = $this->params->get('xsErrorBannerTextPaddingLeft');
  $xsBannerTextPaddingRight = $this->params->get('xsErrorBannerTextPaddingRight');
} else {
  $xsBannerBackgroundImage = $this->params->get('xsBannerBackgroundImage')==""?"":(Uri::root().$this->params->get('xsBannerBackgroundImage'));

  $xsBannerBackgroundImageRepeat = $this->params->get('xsBannerBackgroundImageRepeat');

  $xsBannerBackgroundImagePositionX = $this->params->get('xsBannerBackgroundImagePositionX');
  $xsBannerBackgroundImagePositionY = $this->params->get('xsBannerBackgroundImagePositionY');
  $xsBannerBackgroundImageSizeType = $this->params->get('xsBannerBackgroundImageSize');

  $xsBannerBackgroundImagePositionX = $xsBannerBackgroundImagePositionX=="value"?$this->params->get('xsBannerBackgroundImagePositionXValue'):$xsBannerBackgroundImagePositionX;
  $xsBannerBackgroundImagePositionY = $xsBannerBackgroundImagePositionY=="value"?$this->params->get('xsBannerBackgroundImagePositionYValue'):$xsBannerBackgroundImagePositionY;
  $xsBannerBackgroundImageSize = $xsBannerBackgroundImageSizeType=="value"?$this->params->get('xsBannerBackgroundImageSizeValue'):($xsBannerBackgroundImageSizeType=="fixed"?"":($xsBannerBackgroundImageSizeType=="fill"?"100% 100%":""));

  $xsBannerPaddingTop = $this->params->get('xsBannerPaddingTop');
  $xsBannerPaddingBottom = $this->params->get('xsBannerPaddingBottom');

  $xsBannerTextPaddingTop = $this->params->get('xsBannerTextPaddingTop');
  $xsBannerTextPaddingLeft = $this->params->get('xsBannerTextPaddingLeft');
  $xsBannerTextPaddingRight = $this->params->get('xsBannerTextPaddingRight');

  if($xsBannerBackgroundImage == "") {
    $piwigo_url = 'https://gallery.remembering.photos/ws.php?format=json';
    $api_key = 'pkid-20260719-LZhFwScdOD2pto3Yl6LX:GSqOA0O44m1pzMBDvC3ec6XcVFzDTk7Be71ah31t'; 

    $post_fields = [
        'method'   => 'pwg.categories.getImages',
        'per_page' => 1,       // Max photos to fetch per rotation cycle
        'order'    => 'random'  // Keeps the array shuffled
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $piwigo_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-PIWIGO-API: ' . $api_key
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $image = [];

    if (isset($data['stat']) && $data['stat'] == 'ok' && !empty($data['result']['images'])) {
        $image = $data['result']['images'][0];
    }

    $xsBannerPiwigoImage = htmlspecialchars($image['element_url']);
    $xsBannerPiwigoImageName = htmlspecialchars($img['name']);
    $xsBannerPiwigoImageComment = htmlspecialchars($img['comment']);
  }
}
?>

<?php if ($xsBannerBackgroundImage != "") : ?>
	/* xs banner image */
	.banner-xs .panel {
		background-image: url(<?php echo $xsBannerBackgroundImage; ?>);
<?php if ($xsBannerBackgroundImageSizeType == "fill") : ?>
		background-repeat: no-repeat;
<?php else: ?>
		background-position-x: <?php echo $xsBannerBackgroundImagePositionX; ?>;
		background-position-y: <?php echo $xsBannerBackgroundImagePositionY; ?>;
		background-repeat: <?php echo $xsBannerBackgroundImageRepeat; ?>;
<?php endif; ?>
<?php if ($xsBannerBackgroundImageSize != "") : ?>
		background-size: <?php echo $xsBannerBackgroundImageSize; ?>;
		height: <?php echo $xsBannerBackgroundImageSize; ?>;
<?php endif; ?>
	}
<?php endif; ?>

<?php if ($xsBannerTextPaddingTop != "" || $xsBannerTextPaddingLeft != "" || $xsBannerTextPaddingRight != "") : ?>
	.banner-xs .panel {	
<?php if ($xsBannerTextPaddingTop != "") : ?>
		padding-top: <?php echo $xsBannerTextPaddingTop; ?>;
<?php endif; ?>
<?php if ($xsBannerTextPaddingLeft != "") : ?>
		padding-left: <?php echo $xsBannerTextPaddingLeft; ?>;
<?php endif; ?>
<?php if ($xsBannerTextPaddingRight != "") : ?>
		padding-right: <?php echo $xsBannerTextPaddingRight; ?>;
<?php endif; ?>
	}
<?php endif; ?>

<?php if ($xsBannerPaddingTop != "" || $xsBannerPaddingBottom != "") : ?>
	.banner-xs {	
<?php if ($xsBannerPaddingTop != "") : ?>
		padding-top: <?php echo $xsBannerPaddingTop; ?>;
<?php endif; ?>
<?php if ($xsBannerPaddingBottom != "") : ?>
		padding-bottom: <?php echo $xsBannerPaddingBottom; ?>;
<?php endif; ?>
	}
<?php endif; ?>
