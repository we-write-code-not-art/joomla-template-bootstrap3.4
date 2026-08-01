<?php
use Joomla\CMS\Uri\Uri;

if($this->error) {
  $templateBackgroundImage = $this->params->get('errorSiteBackgroundImage')==""?"":Uri::root().$this->params->get('errorSiteBackgroundImage');

  if ($templateBackgroundImage!='') {
    $templateBackgroundImageRepeat = $this->params->get('errorSiteBackgroundImageRepeat');

    $templateBackgroundImageAttachment = $this->params->get('errorSiteBackgroundImageAttachment');
    $templateBackgroundImageSize = $this->params->get('errorSiteBackgroundImageSize')=="value"?$this->params->get('errorSiteBackgroundImageSizeValue'):$this->params->get('errorSiteBackgroundImageSize');
    $templateBackgroundImagePositionX = $this->params->get('errorSiteBackgroundImagePositionX')=="value"?$this->params->get('errorSiteBackgroundImagePositionXValue'):$this->params->get('errorSiteBackgroundImagePositionX');
    $templateBackgroundImagePositionY = $this->params->get('errorSiteBackgroundImagePositionY')=="value"?$this->params->get('errorSiteBackgroundImagePositionYValue'):$this->params->get('errorSiteBackgroundImagePositionY');
  }
} else {
  $templateBackgroundImage = $this->params->get('templateBackgroundImage')==""?"":Uri::root().$this->params->get('templateBackgroundImage');

  if ($templateBackgroundImage!='') {
    $templateBackgroundImageRepeat = $this->params->get('templateBackgroundImageRepeat');

    $templateBackgroundImageAttachment = $this->params->get('templateBackgroundImageAttachment');
    $templateBackgroundImageSize = $this->params->get('templateBackgroundImageSize')=="value"?$this->params->get('templateBackgroundImageSizeValue'):$this->params->get('templateBackgroundImageSize');
    $templateBackgroundImagePositionX = $this->params->get('templateBackgroundImagePositionX')=="value"?$this->params->get('templateBackgroundImagePositionXValue'):$this->params->get('templateBackgroundImagePositionX');
    $templateBackgroundImagePositionY = $this->params->get('templateBackgroundImagePositionY')=="value"?$this->params->get('templateBackgroundImagePositionYValue'):$this->params->get('templateBackgroundImagePositionY');
  }
}  
?>

<?php if ($templateBackgroundImage != "" or 1) : ?>
	/* template background image */
	body {
		background-image: url(<?php echo $templateBackgroundImage; ?>);
		background-repeat: <?php echo $templateBackgroundImageRepeat; ?>;
		background-position-x: <?php echo $templateBackgroundImagePositionX; ?>;
		background-position-y: <?php echo $templateBackgroundImagePositionY; ?>;
		background-attachment: <?php echo $templateBackgroundImageAttachment; ?>;
		background-size: <?php echo $templateBackgroundImageSize; ?>;
		height: <?php echo $templateBackgroundImageSize; ?>;
	}
<?php endif; ?>
