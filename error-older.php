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

$cssFile = $this->params->get('cssFile');
$faviconDir = $this->params->get('faviconDir');
$faviconPath=$templatePath . '/images/favicons/'.$faviconDir;


// Add JavaScript Frameworks
//HTMLHelper::_('jquery.framework');
//HTMLHelper::_('bootstrap.framework');
HTMLHelper::_('script', 'jquery.min.js', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('script', 'bootstrap.min.js', ['version' => 'auto', 'relative' => true]);
// Add Stylesheets
$doc->addStyleSheet($templatePath . '/css/'.$cssFile);

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
$hasBannerHeader=$this->countModules('banner-header')>0;
$hasBannerFooter=$this->countModules('banner-footer')>0;
$hasxsBannerHeader=$this->countModules('xs-banner-header')>0;
$hasxsBannerFooter=$this->countModules('xs-banner-footer')>0;

$showCollapsedDivider = ($hasCollapsedMenu+$hasCollapsedProfileMenu+$isLoggedIn+$hasCollapsedFooterMenu)>1;

$themeColor = $this->params->get('themeColor');
$ieTileColor = $this->params->get('ieTileColor');

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

$bannerSiteDescription = "";
if ($bannerShowSiteDescription) {
	$bannerSiteDescription = $this->params->get('bannerSiteDescription');
}

$xsMenuHasBrandImage = $this->params->get('xsMenuBrandImage')!="";
$xsMenuBrandImage = $xsMenuHasBrandImage?(Uri::root().$this->params->get('xsMenuBrandImage')):"";

$xsMenuSiteNameType=$this->params->get('xsMenuSiteNameType');
$xsMenuSiteNameImage=$xsMenuSiteNameType=="image"?(Uri::root().$this->params->get('xsMenuSiteNameImage')):"";
$xsMenuSiteName = $this->params->get('xsMenuSiteName')==""?$siteName:$this->params->get('xsMenuSiteName');
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

$xsBannerBackgroundImage = $this->params->get('xsBannerBackgroundImage')==""?"":(Uri::root().$this->params->get('xsBannerBackgroundImage'));

$showxsBanner=(($xsBannerSiteName!="" && $xsBannerSiteDescription!="") || $xsBannerBackgroundImage!="");
$showxsBannerAll=($showxsBanner || $hasxsBannerHeader || $hasxsBannerFooter);

$bannerParallaxImage = $this->params->get('bannerParallaxImage')==""?"":(Uri::root().$this->params->get('bannerParallaxImage'));
//$bannerHeightLg="600";
$bannerParallaxSpeed= $this->params->get('bannerParallaxSpeed');
$includeParallax=($bannerParallaxImage!='')>0;

$mainContentInWell = $this->params->get('mainContentInWell');

$footerOuterFixedToBottom=$this->params->get('footerOuterFixedToBottom');

$showCollapedMenu=($xsMenuHasBrandImage || $hasCollapsedMenu || $hasCollapsedProfileMenu || $hasCollapsedFooterMenu || $isLoggedIn);

//$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
//$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
//$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

//see css.php for more variable declarations

$errorCode = $this->error->getCode();
$renderModules = $app->getIdentity() && $app->getLanguage();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
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

<?php include "css.php" ?>

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

  <style>
    .breadcrumb-item + .breadcrumb-item:before, .breadcrumb > li + li:before {
        float: left;
        padding-right: var(--breadcrumb-item-padding-x);
        color: var(--breadcrumb-divider-color);
    }
    .divider:before {
        content: var(--breadcrumb-divider, " · ");
    }

    .pg-category-box, .pg-item-box {
      overflow: hidden;
    }     

	.banner .panel .overlay {
		//background-image: url(/images/templates/<?php echo $this->template; ?>/site/error.png#joomlaImage://local-images/templates/<?php echo $this->template; ?>/site/error.png);
		background-image: url(/images/templates/dev-michael-allen/site/error.png#joomlaImage://local-images/templates/dev-michael-allen/site/error.png);
  }

  </style>
 </head>

<body class="site error_site <?php echo $option
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
<?php if ($bannerIsFluid) : ?>
		<header class="banner hidden-xs" >
<?php   if ($bannerParallaxImage!='') : ?>
			<div class="panel" data-parallax="scroll"  data-speed="<?php echo $bannerParallaxSpeed; ?>" data-image-src="<?php echo $bannerParallaxImage; ?>">
<?php   else: ?>
			<div class="panel">
<?php   endif; ?>
				<div class="overlay"></div>
				<div class="panel-body">
							<div class="media">
<?php   if ($bannerLogoImage!='' && $bannerLogoPlacement=="media-left") : ?>
								<div class="<?php echo $bannerLogoPlacement; ?>">
									<img id="banner-logo-img" class="media-object" src="<?php echo $bannerLogoImage; ?>" alt="<?php echo $siteName; ?>" />
								</div>
<?php   endif; ?>
								<div class="media-body">
<?php   if ($bannerShowSiteName) : ?>
									<h1 class="media-heading <?php echo $bannerSiteNameHorizontalAlignment; ?>"><?php echo $bannerSiteName; ?></h1> 
<?php   endif; ?>
<?php   if ($bannerShowSiteDescription) : ?>
									<p class="text-justify"><?php echo $bannerSiteDescription; ?></p> 
<?php   endif; ?>
								</div>
<?php   if ($bannerLogoImage!='' && $bannerLogoPlacement=="media-right") : ?>
								<div class="<?php echo $bannerLogoPlacement; ?>">
									<img id="banner-logo-img" class="media-object" src="<?php echo $bannerLogoImage; ?>" alt="<?php echo $siteName; ?>" />
								</div>
<?php   endif; ?>
							</div>
				</div>
			</div>
		</header>
<?php endif; ?>

<?php if ($renderModules && ($isMainMenuFluid==1) && ($hasMainMenu)) : ?>
		<nav class="navbar navbar-mainmenu hidden-xs <?php echo $mainMenuFluid; ?>">
			<jdoc:include type="modules" name="main-menu" style="none" />
		</nav>
<?php endif; ?>

<?php if ($renderModules && ($isMainMenuFluid==2) && ($hasMainMenu)) : ?>
		<nav class="navbar navbar-mainmenu hidden-xs <?php echo $mainMenuFluid; ?>">
			<div class="container"><jdoc:include type="modules" name="main-menu" style="none" /></div>
		</nav>
<?php endif; ?>

	<div class="body-panel panel <?php echo $containerFluid; ?>">

<?php if ($xsMenuHasBrandImage || $hasCollapsedMenu || $hasCollapsedProfileMenu || $hasCollapsedFooterMenu || $isLoggedIn) : ?>
		<nav class="navbar navbar-xsmenu visible-xs-block navbar-fixed-top">
			<div>
				<div class="navbar-header">
<?php   if ($hasCollapsedMenu || $hasCollapsedProfileMenu || $hasCollapsedFooterMenu) : ?>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-xsmenu-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
<?php   endif; ?>
          <a href="/">
<?php   if ($xsMenuHasBrandImage and $xsMenuSiteNameImage=="") : ?>
						<span class="navbar-brand navbar-xsmenu-logo"><img src="<?php echo $xsMenuBrandImage; ?>" alt="<?php echo $xsMenuSiteName; ?>"  /></span>
						<span class="navbar-brand">
							<?php echo $xsMenuSiteName; ?>
						</span>
<?php   endif; ?>

<?php   if ($xsMenuHasBrandImage and $xsMenuSiteNameImage!="") : ?>
						<span class="navbar-brand navbar-xsmenu-logo"><img src="<?php echo $xsMenuBrandImage; ?>" alt="<?php echo $xsMenuSiteName; ?>"  /></span>
						<span class="navbar-brand navbar-xsmenu-sitename-image">
						<img src="<?php echo $xsMenuSiteNameImage; ?>" alt="<?php echo $xsMenuSiteName; ?>"  />
            </span>
<?php   endif; ?>

<?php   if (!$xsMenuHasBrandImage and $xsMenuSiteNameImage=="") : ?>
						<span class="navbar-brand">
							<?php echo $xsMenuSiteName; ?>
						</span>
<?php   endif; ?>

<?php   if (!$xsMenuHasBrandImage and $xsMenuSiteNameImage!="") : ?>
						<span class="navbar-brand navbar-xsmenu-sitename-image">
							<img src="<?php echo $xsMenuSiteNameImage; ?>" alt="<?php echo $xsMenuSiteName; ?>"  />
						</span>
<?php   endif; ?>
					</a>
				</div>
<?php   if ($renderModules && ($hasCollapsedMenu || $hasCollapsedProfileMenu || $hasCollapsedFooterMenu || $isLoggedIn)) : ?>
				<div class="navbar-collapse collapse" id="navbar-xsmenu-collapse">
<?php     if ($hasCollapsedMenu) : ?>
					<jdoc:include type="modules" name="menu-collapsed" style="none" />
<?php     endif; ?>
<?php     if ($hasCollapsedProfileMenu || $isLoggedIn) : ?>
					<div class="navbar-divider"></div>
<?php     endif; ?>
<?php     if ($hasCollapsedProfileMenu || $isLoggedIn) : ?>
					<ul class="nav navbar-nav">
<?php       if ($isLoggedIn) : ?>
						<li>
							<a class="navbar-xsmenu-avatar" href="index.php/edit-profile">
								<span><img alt="<?php echo $user->name; ?>" src="<?php print $userPhoto; ?>" /></span>
								<span><?php echo $user->name; ?></span>
							</a>
						</li>
<?php       endif; ?>
					</ul>
<?php     endif; ?>
<?php     if ($renderModules && $hasCollapsedProfileMenu) : ?>
					<jdoc:include type="modules" name="profile-collapsed" style="none" />
<?php     endif; ?>
<?php     if ($renderModules && $hasCollapsedFooterMenu) : ?>
					<div class="navbar-divider"></div>
					<jdoc:include type="modules" name="footer-collapsed" style="collapsed" />
<?php     endif; ?>
				</div>
<?php   endif; ?>
			</div>
		</nav>
<?php endif; ?>

<?php if ($renderModules && $hasProfileMenu) : ?>
		<nav class="navbar navbar-user hidden-xs navbar-fixed-top">
			<div class="<?php echo $containerFluid; ?>">
<?php   if ($isLoggedIn) : ?>
				<div class="navbar-header">
					<a class="navbar-brand navbar-user-avatar" href="index.php/edit-profile">
						<span><img alt="<?php echo $user->name; ?>" src="<?php print $userPhoto; ?>" /></span>
						<span><?php echo $user->name; ?></span>
					</a>
				</div>
<?php   endif; ?>
				<div class="pull-right">
					<jdoc:include type="modules" name="profile" style="none" />
				</div>
			</div>
		</nav>
<?php endif; ?>

<?php if ($showxsBannerAll) : ?>
		<header class="banner-xs visible-xs-block">
<?php if ($renderModules && $showxsBanner) : ?>
			<div class="panel">
				<div class="panel-body">
					<div class="row">
						<div class="col col-xs-12"<?= $xsBannerFixedHeight !== '' ? ' style="height: '.$xsBannerFixedHeight.';"' : '' ?>>

						<div class="media">
						<div class="media-body">
<?php if ($hasxsBannerHeader) : ?>
							<div style="position: absolute; top: 0;">
                <jdoc:include type="modules" name="xs-banner-header" style="none" />
              </div>
<?php endif; ?>
<?php if ($xsBannerShowSiteName) : ?>
							<h1 class="media-heading <?php echo $xsBannerSiteNameAlignment; ?>"><?php echo $xsBannerSiteName; ?></h1> 
<?php endif; ?>
<?php if ($xsBannerShowSiteDescription) : ?>
							<p class="text-justify"><?php echo $xsBannerSiteDescription; ?></p> 
<?php endif; ?>
<?php if ($renderModules && $hasxsBannerFooter) : ?>
							<div style="position: absolute; bottom: 0;">
                <jdoc:include type="modules" name="xs-banner-footer" style="none" />
              </div>
<?php endif; ?>
						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
<?php endif; ?>
		</header>
<?php endif; ?>

<?php if (!$bannerIsFluid) : ?>
		<header class="banner hidden-xs">
<?php if ($bannerParallaxImage!='') : ?>
			<div class="panel" data-parallax="scroll" data-z-index="1" data-speed="<?php echo $bannerParallaxImage; ?>" data-image-src="<?php echo $bannerBackgroundImage; ?>">
<?php else: ?>
			<div class="panel">
<?php endif; ?>
				<div class="overlay"></div>
				<div class="panel-body">
					<div class="row">
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
					</div>
				</div>
			</div>
		</header>
<?php endif; ?>

<?php if ($renderModules && ($isMainMenuFluid==0)  && ($hasMainMenu)) : ?>
		<nav class="navbar navbar-mainmenu hidden-xs <?php echo $mainMenuFluid; ?>">
			<jdoc:include type="modules" name="main-menu" style="none" />
		</nav>
<?php endif; ?>

<?php if ($renderModules && $hasBreadcrumbs) : ?> 
		<div class="row">
			<div class="breadcrumbs hidden-xs col-lg-12">
				<jdoc:include type="modules" name="breadcrumbs" style="none" />
			</div>
		</div>
<?php endif; ?>
<?php if ($renderModules && $hasSearch) :?> 
		<div class="row">
			<div class="pull-right text-right col-lg-3" >
					<jdoc:include type="modules" name="search" style="none" />
			</div>
		</div>
<?php endif; ?>

		<div class="content content-pane">
			<div class="row">
<?php if ($renderModules && $hasSidebarLeft) : ?>
				<div class="col-lg-3 sidebar sidebar-left">
					<div class="well">
						<jdoc:include type="modules" name="sidebar-left" style="card" />
					</div>
				</div>
<?php endif; ?>
				<main role="main" class="main-content <?php echo $middle_column; ?>">
<?php if ($renderModules && $mainContentInWell) : ?>
					<div class="panel">
						<div class="panel-body">
<?php endif; ?>
            <?php if ($renderModules && $this->countModules('error-' . $errorCode)) : ?>
						<jdoc:include type="message" />
            <? endif; ?>
						<jdoc:include type="modules" name="content-header" style="none" />
            <?php if ($renderModules && $this->countModules('error-' . $errorCode)) : ?>
            <jdoc:include type="modules" name="error-<?php echo $errorCode; ?>" style="none" />
            <?php else : ?>
            <h1 class="page-header"><?php echo Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
            <div class="card">
                <div class="card-body">
                    <jdoc:include type="message" />
                    <main>
                        <p><strong><?php echo Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
                        <p><?php echo Text::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
                        <ul>
                            <li><?php echo Text::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
                            <li><?php echo Text::_('JERROR_LAYOUT_MISTYPED_ADDRESS'); ?></li>
                            <li><?php echo Text::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
                            <li><?php echo Text::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
                        </ul>
                        <p><?php echo Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
                        <p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn btn-secondary"><span class="icon-home" aria-hidden="true"></span> <?php echo Text::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
                        <hr>
                        <p><?php echo Text::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
                        <blockquote>
                            <span class="badge bg-secondary"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?><br/>
                            <?php echo Uri::getInstance(); ?>
                        </blockquote>                       
                    </main>
                </div>
            </div>
            <? endif; ?>
						<jdoc:include type="modules" name="content-footer" style="none" />
<?php if ($mainContentInWell) : ?>
						</div>
					</div>
<?php endif; ?>
				</main>
<?php if ($renderModules && $hasSidebarRight) : ?>
				<div class="col-lg-3 sidebar sidebar-right">
					<jdoc:include type="modules" name="sidebar-right" style="well" />
				</div>
<?php endif; ?>
			</div>
		</div>
	</div>	

<?php if ($footerOuterFixedToBottom) : ?>
		<footer class="footer-fixed-bottom navbar-fixed-bottom hidden-xs" >
		</footer>
<?php endif; ?>

		<footer class="footer-outer hidden-xs" >
				<div class="<?php echo $containerFluid; ?>" >
					<div class="rows">
					
<?php if ($renderModules && $hasFooter) : ?>
						<div class="panel footer-inner">
              <div class="row">
                <div class="col-md-12 xvisible-lg-block">
                  <jdoc:include type="modules" name="footer" style="none" />
                </div>
              </div>
						</div>
<?php endif; ?>
					
				</div>
				<div class="row">
					<div class="col-lg-12">
						<p class="pull-right">
							<a href="#top" id="back-top"><?php echo Text::_('Back to top'); ?></a>
						</p>
					</div>
				</div>
		</footer>

		<footer class="footer-outer-xs container visible-xs-block" >
<?php if ($renderModules && $hasxsFooter) : ?>
			<div class="panel footer-inner-xs">
				<jdoc:include type="modules" name="footer-extra-small" style="none" />
			</div>
<?php endif; ?>
			<div class="row">
				<div class="col-lg-12">
					<p class="pull-right">
						<a href="#top" id="back-top"><?php echo Text::_('Back to top'); ?></a>
					</p>
				</div>
			</div>
		</footer>

    <?php if ($this->debug) : ?>
        <div>
            <?php echo $this->renderBacktrace(); ?>
            <?php // Check if there are more Exceptions and render their data as well ?>
            <?php if ($this->error->getPrevious()) : ?>
                <?php $loop = true; ?>
                <?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
                <?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
                <?php $this->setError($this->_error->getPrevious()); ?>
                <?php while ($loop === true) : ?>
                    <p><strong><?php echo Text::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
                    <p><?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php echo $this->renderBacktrace(); ?>
                    <?php $loop = $this->setError($this->_error->getPrevious()); ?>
                <?php endwhile; ?>
                <?php // Reset the main error object to the base error ?>
                <?php $this->setError($this->error); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($renderModules) : ?>
      <jdoc:include type="modules" name="debug" style="none" />
    <?php endif; ?>
  
</body>
</html>
