<?php
use Joomla\CMS\Uri\Uri;

$xsMenuBackgroundImage = $this->params->get('xsMenuBackgroundImage')==""?"":(Uri::root().$this->params->get('xsMenuBackgroundImage'));

$xsMenuBackgroundImageRepeat = $this->params->get('xsMenuBackgroundImageRepeat');

$xsMenuBackgroundImagePositionX = $this->params->get('xsMenuBackgroundImagePositionX');
$xsMenuBackgroundImagePositionY = $this->params->get('xsMenuBackgroundImagePositionY');
$xsMenuBackgroundImageSizeType = $this->params->get('xsMenuBackgroundImageSize');

$xsMenuBackgroundImagePositionX = $xsMenuBackgroundImagePositionX=="value"?$this->params->get('xsMenuBackgroundImagePositionXValue'):$xsMenuBackgroundImagePositionX;
$xsMenuBackgroundImagePositionY = $xsMenuBackgroundImagePositionY=="value"?$this->params->get('xsMenuBackgroundImagePositionYValue'):$xsMenuBackgroundImagePositionY;
$xsMenuBackgroundImageSize = $xsMenuBackgroundImageSizeType=="value"?$this->params->get('xsMenuBackgroundImageSizeValue'):($xsMenuBackgroundImageSizeType=="fixed"?"":($xsMenuBackgroundImageSizeType=="fill"?"100% 100%":""));
?>
<?php if ($xsMenuBackgroundImage != "") : ?>
	/* xs banner image */
	.navbar-xsmenu {
		background-image: url(<?php echo $xsMenuBackgroundImage; ?>);
<?php if ($xsMenuBackgroundImageSizeType == "fill") : ?>
		background-repeat: no-repeat;
<?php else: ?>
		background-position-x: <?php echo $xsMenuBackgroundImagePositionX; ?>;
		background-position-y: <?php echo $xsMenuBackgroundImagePositionY; ?>;
		background-repeat: <?php echo $xsMenuBackgroundImageRepeat; ?>;
<?php endif; ?>
<?php if ($xsMenuBackgroundImageSize != "") : ?>
		background-size: <?php echo $xsMenuBackgroundImageSize; ?>;
<?php endif; ?>
	}
<?php endif; ?>
