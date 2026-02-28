<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;

$app             = Factory::getApplication();
$doc             = Factory::getDocument();
$user            = Factory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
//$params = $app->getTemplate(true)->params;
$template = $app->getTemplate(true);

if (is_object($template) && method_exists($template, 'getParams')) {
    $params = $template->getParams();
} else {
    // Legacy / stdClass fallback
    $params = new Joomla\Registry\Registry($template->params ?? []);
}

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
/*
require_once JPATH_BASE.'/plugins/slogin_integration/profile/helper.php';
$profile = plgProfileHelper::getProfile($user->id);
print($profile);
echo $user->id;
echo $profile->avatar;
*/

if($task == "edit" || $layout == "form" ) {
	$fullWidth = 1;
} else {
	$fullWidth = 0;
}
//include "config.php";

$templatePath=$this->baseurl . '/templates/' . $this->template;

$cssFile = $this->params->get('cssErrorFile')==""?($this->params->get('cssFile')):($this->params->get('cssErrorFile'));
$faviconDir = $this->params->get('faviconDir');
$faviconPath=$templatePath . '/images/favicons/'.$faviconDir;


// Add JavaScript Frameworks
//HTMLHelper::_('jquery.framework');
//HTMLHelper::_('bootstrap.framework');
HTMLHelper::_('script', 'jquery.min.js', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('script', 'bootstrap.min.js', ['version' => 'auto', 'relative' => true]);
// Add Stylesheets
$doc->addStyleSheet($templatePath . '/style/base.css');
$doc->addStyleSheet($templatePath . '/style/'.$cssFile);

// Load optional RTL Bootstrap CSS
HTMLHelper::_('bootstrap.loadCss', false, $this->direction);

if ($this->params->get('siteTitle')) {
	$siteName = htmlspecialchars($this->params->get('siteTitle'));
} else {
	$siteName = $app->get('sitename');
}

// Adjusting content width
if ($this->countModules('sidebar-right') && $this->countModules('sidebar-left')) {
	$middle_column = "col-lg-6";
} elseif ($this->countModules('sidebar-right') && !$this->countModules('sidebar-left')) {
	$middle_column = "col-lg-9";
} elseif (!$this->countModules('sidebar-right') && $this->countModules('sidebar-left')) {
	$middle_column = "col-lg-9";
} else {
	$middle_column = "col-lg-12";
}

$isFluid = $params->get('fluidContainer');
$fluid = $isFluid ? '-fluid' : '';
$containerFluid="container" . $fluid;

$isMainMenuFluid = $params->get('fluidMainMenu');
$mainMenuFluid=($isMainMenuFluid==1)?'row':'';

$bannerIsFluid = $params->get('fluidBanner');

$username = $user->name;
$isLoggedIn = $username != '';

JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
$fields= FieldsHelper::getFields('com_users.user', $user, true);
foreach($fields as $field) {
	$customUserFields[$field->name]=$field->rawvalue;
}

if($isLoggedIn) {	
	if($customUserFields["photo"]!="") {
		$userPhoto=JUri::root().$customUserFields["photo"];
	} else {
		$userPhoto=$templatePath.'/images/user.png';
	}
} else {
	$userPhoto="";
}

$hasCollapsedMenu = $this->countModules('menu-collapsed')>0;
$hasCollapsedProfileMenu = $this->countModules('profile-collapsed')>0;
$hasCollapsedFooterMenu = $this->countModules('footer-collapsed')>0;
$hasProfileMenu = $this->countModules('profile')>0;
$hasMainMenu = $this->countModules('main-menu')>0;
$hasBreadcrumbs = $this->countModules('breadcrumbs')>0;
$hasSearch = $this->countModules('search')>0;
$hasSidebarLeft = $this->countModules('sidebar-left')>0;
$hasSidebarRight = $this->countModules('sidebar-right')>0;
$hasFooter = $this->countModules('footer')>0;
$hasxsFooter = $this->countModules('footer-extra-small')>0;
$hasContentHeader=$this->countModules('content-header')>0;
$hasContentFooter=$this->countModules('content-footer')>0;

$hasBannerHeader=$this->countModules('banner-header')>0;
$hasBannerFooter=$this->countModules('banner-footer')>0;

$hasxsBannerHeader=$this->countModules('xs-banner-header')>0;
$hasxsBannerFooter=$this->countModules('xs-banner-footer')>0;

$hasDebug=$this->countModules('debug')>0;

$showCollapsedDivider = ($hasCollapsedMenu+$hasCollapsedProfileMenu+$isLoggedIn+$hasCollapsedFooterMenu)>1;

$themeColor = $this->params->get('themeColor');
$ieTileColor = $this->params->get('ieTileColor');

// handled by modules positions now
$bannerShowSiteName = $this->params->get('bannerShowSiteName');
$bannerShowSiteDescription = $this->params->get('bannerShowSiteDescription');
$bannerSiteNameHorizontalAlignment =  $this->params->get('bannerSiteNameHorizontalAlignment');
$bannerSiteNameVerticalAlignment =  $this->params->get('bannerSiteNameVerticalAlignment');

$bannerSiteName = "";
if ($bannerShowSiteName) {
	$bannerSiteName = $this->params->get('bannerSiteName');
	if ($bannerSiteName=="") {
		$bannerSiteName = $siteName;
	}
}

$bannerLogoImage = $this->params->get('bannerLogoImage')==""?"":(Uri::root().$this->params->get('bannerLogoImage'));
$bannerLogoPlacement = $this->params->get('bannerLogoPlacement');

$bannerSiteDescription = "";
if ($bannerShowSiteDescription) {
	$bannerSiteDescription = $this->params->get('bannerSiteDescription');
}

$xsMenuHasBrandImage = $this->params->get('xsMenuBrandImage')!="";
$xsMenuBrandImage = $xsMenuHasBrandImage?(Uri::root().$this->params->get('xsMenuBrandImage')):"";

//$xsMenuSiteNameType=$this->params->get('xsMenuSiteNameType');
//$xsMenuSiteNameImage=$xsMenuSiteNameType=="image"?(Uri::root().$this->params->get('xsMenuSiteNameImage')):"";
$xsMenuSiteNameType = "text";
$xsMenuSiteName = $this->params->get('xsErrorMenuSiteName')==""?$siteName:$this->params->get('xsErrorMenuSiteName');
$xsMenuSiteNameImageClass=$xsMenuSiteNameImage==""?"":"navbar-xsmenu-sitename-image";

if ($xsMenuBrandImage=="") {
	$xsMenuHasBrandImage=false;
}

$xsBannerShowSiteName = $this->params->get('xsBannerShowSiteName');
$xsBannerShowSiteDescription = $this->params->get('xsBannerShowSiteDescription');
$xsBannerSiteNameAlignment =  $this->params->get('xsBannerSiteNameAlignment');
$xsBannerFixedHeight = ($h = trim((string) $this->params->get('xsBannerFixedHeight'))) !== '' ? $h.'px' : '';

$xsBannerSiteName = "";
if ($xsBannerShowSiteName) {
	$xsBannerSiteName = $this->params->get('xsBannerSiteName');
	if ($xsBannerSiteName=="") {
		$xsBannerSiteName = $bannerSiteName;
		if ($xsBannerSiteName=="") {
			$xsBannerSiteName = $siteName;
		}
	}
}

$xsBannerSiteDescription = "";
if ($xsBannerShowSiteDescription) {
	$xsBannerSiteDescription = $this->params->get('xsBannerSiteDescription');
	if ($xsBannerSiteDescription=="") {
		$xsBannerSiteDescription = $bannerSiteDescription;
	}
}

$xsBannerBackgroundImage = $this->params->get('xsErrorBannerBackgroundImage')==""?"":(Uri::root().$this->params->get('xsErrorBannerBackgroundImage'));

$showxsBanner=(($xsBannerSiteName!="" && $xsBannerSiteDescription!="") || $xsBannerBackgroundImage!="");
$showxsBannerAll=($showxsBanner || $hasxsBannerHeader || $hasxsBannerFooter);

$bannerParallaxImage = $this->params->get('errorBannerParallaxImage')==""?"":(Uri::root().$this->params->get('errorBannerParallaxImage'));
//$bannerHeightLg="600";
$bannerParallaxSpeed= $this->params->get('errorBannerParallaxSpeed');
$includeParallax=($bannerParallaxImage!='')>0;

$mainContentInWell = $this->params->get('mainContentInWell');

$footerOuterFixedToBottom=$this->params->get('footerOuterFixedToBottom');

$showCollapedMenu=($xsMenuHasBrandImage || $hasCollapsedMenu || $hasCollapsedProfileMenu || $hasCollapsedFooterMenu || $isLoggedIn);

//$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
//$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
//$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

//see css.php for more variable declarations

$renderModules = $app->getIdentity() && $app->getLanguage();
$errorCode = $this->error->getCode();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  <title>Error: <?php echo $this->error->getCode() . ' ' . htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="icon" type="image/png" href="<?php echo $faviconPath; ?>/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="<?php echo $faviconPath; ?>/favicon.svg" />
  <link rel="shortcut icon" href="<?php echo $faviconPath; ?>/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $faviconPath; ?>/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="<?php echo $siteName; ?>" />
  <link rel="manifest" href="<?php echo $faviconPath; ?>/site.webmanifest" />

<?php if ($ieTileColor != '') : ?>
	<meta name="msapplication-TileColor" content="<?php echo $ieTileColor; ?>">
<?php endif; ?>
	
<?php if ($themeColor != '') : ?>
	<meta name="theme-color" content="<?php echo $themeColor; ?>">
<?php endif; ?>

	<jdoc:include type="head" />

<?php if ($includeParallax != '') : ?>
	<script src="<?php echo $templatePath; ?>/js/jquery.parallax.min.js" type="text/javascript"></script>
<?php endif; ?>

<?php include "css.php"; ?>

	<!--[if lt IE 9]>
		<script src="<?php echo Uri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
	<script>
		function fixSidebarLeft() {
			var v = 0;
			 jQuery('.sidebar-left').children('.well').children().each(function() {
				if(jQuery(this).css('display') != "none") {
					v++;
					jQuery('.sidebar-left').show();
					return
				}
				jQuery('.sidebar-left').hide();
			});
		}

		jQuery(document).ready(function() {
			fixSidebarLeft();
			jQuery(window).resize(function() {
				fixSidebarLeft();
			});
		});
	</script>

  <jdoc:include type="styles" />
 </head>

<body class="site error-site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($isFluid ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">

<?php if ($showCollapedMenu) : ?>
		<div style="height: 50px;" class="visible-xs-block"></div>
<?php endif; ?>

<?php 
  // static is handled in body.php
  if ($bannerIsFluid) : 
    include "build/banner-fluid.php";
  endif; 

  // static is handled in body.php
  include "build/mainmenu-not-static.php";

  include "build/body-error.php"; 

  include "build/footer.php"; 
?>
</body>
</html>
