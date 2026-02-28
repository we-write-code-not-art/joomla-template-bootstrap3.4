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
