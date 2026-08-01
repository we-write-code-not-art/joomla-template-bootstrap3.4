<?php
use Joomla\CMS\Uri\Uri;

$footerPaddingTop = $this->params->get('footerPaddingTop');
$footerPaddingBottom = $this->params->get('footerPaddingBottom');

$footerOuterFixedToBottom = $this->params->get('footerOuterFixedToBottom')? 'navbar-fixed-bottom': '';
$footerIsOuterFixed=$footerOuterFixedToBottom<>'';
$footerOuterFixedHeight = $this->params->get('footerOuterFixedHeight');

$footerOuterImageRepeat = $this->params->get('footerOuterImageRepeat');

$footerOuterImagePositionX = $this->params->get('footerOuterImagePositionX');
$footerOuterImagePositionY = $this->params->get('footerOuterImagePositionY');
$footerOuterImageSizeType = $this->params->get('footerOuterImageSize');
$footerOuterImageAttachment = $this->params->get('footerOuterImageAttachment');

$footerOuterImagePositionX = $footerOuterImagePositionX=="value"?$this->params->get('footerOuterImagePositionXValue'):$footerOuterImagePositionX;
$footerOuterImagePositionY = $footerOuterImagePositionY=="value"?$this->params->get('footerOuterImagePositionYValue'):$footerOuterImagePositionY;
$footerOuterImageSize = $footerOuterImageSizeType=="value"?$this->params->get('footerOuterImageSizeValue'):($footerOuterImageSizeType=="fixed"?"":($footerOuterImageSizeType=="fill"?"100% 100%":""));

$footerOuterImage = $this->params->get('footerOuterImage')==""?"":(Uri::root().$this->params->get('footerOuterImage'));
?>

<?php if ($footerPaddingTop != "" || $footerPaddingBottom != "") : ?>
	.footer-outer {	
<?php if ($footerPaddingTop != "") : ?>
		padding-top: <?php echo $footerPaddingTop; ?>;
<?php endif; ?>
<?php if ($footerPaddingBottom != "") : ?>
		padding-bottom: <?php echo $footerPaddingBottom; ?>;
<?php endif; ?>
	}
<?php endif; ?>
<?php if ($footerOuterImage != "") : ?>
	/* banner background image */
<?php if ($footerIsOuterFixed) : ?>
	.footer-fixed-bottom {
<?php else: ?>
	.footer-outer {
<?php endif; ?>
		background-image: url(<?php echo $footerOuterImage; ?>);
<?php if ($footerOuterImageSizeType == "fill") : ?>
		background-repeat: no-repeat;
<?php else: ?>
		background-position-x: <?php echo $footerOuterImagePositionX; ?>;
<?php if ($footerOuterImageAttachment == "fixed") : ?>
		background-position-y: bottom;
<?php else: ?>
		background-position-y: <?php echo $footerOuterImagePositionY; ?>;
<?php endif; ?>
		background-repeat: <?php echo $footerOuterImageRepeat; ?>;
<?php endif; ?>
<?php if ($footerOuterImageSize != "") : ?>
		background-size: <?php echo $footerOuterImageSize; ?>;
		height: <?php echo $footerOuterImageSize; ?>;
<?php endif; ?>
<?php if ($footerOuterFixedHeight != "") : ?>
		height: <?php echo $footerOuterFixedHeight; ?>;
<?php endif; ?>
    z-index: -1;
	}
<?php endif; ?>
