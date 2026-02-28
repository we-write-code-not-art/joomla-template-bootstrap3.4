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
<?php   if ($hasCollapsedMenu || $hasCollapsedProfileMenu || $hasCollapsedFooterMenu || $isLoggedIn) : ?>
				<div class="navbar-collapse collapse" id="navbar-xsmenu-collapse">
<?php     if ($renderModules && $hasCollapsedMenu) : ?>
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
