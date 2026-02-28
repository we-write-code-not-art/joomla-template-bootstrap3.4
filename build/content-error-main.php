<?php 
  use Joomla\CMS\Language\Text;
  use Joomla\CMS\Uri\Uri;
?>
				<main role="main" class="main-content <?php echo $middle_column; ?>">
<?php if ($mainContentInWell) : ?>
					<div class="panel">
						<div class="panel-body">
<?php endif; ?>
						<jdoc:include type="message" />
						<jdoc:include type="modules" name="content-header" style="none" />

            <?php if ($renderModules && $this->countModules('error-' . $errorCode)) : ?>
						<jdoc:include type="message" />
            <? endif; ?>
						<jdoc:include type="modules" name="content-header" style="none" />
            <?php if ($renderModules && $this->countModules('error-' . $errorCode)) : ?>
            <jdoc:include type="modules" name="error-<?php echo $errorCode; ?>" style="none" />
            <?php else : ?>
            <?php if($errorCode == 500): ?>
            <h1 class="page-header"><?php echo Text::_('An internal server error has occurred.'); ?></h1>
            <div class="card">
                <div class="card-body">
                    <jdoc:include type="message" />
                    <main>
                        <p><strong><?php echo Text::_('The website encountered an internal error and was unable to complete your request.'); ?></strong></p>
                        <p><?php echo Text::_('Please try again later.'); ?></p>
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

            <?php else: ?>
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
            <?php endif; ?>
            <?php endif; ?>

						<jdoc:include type="modules" name="content-footer" style="none" />
<?php if ($mainContentInWell) : ?>
						</div>
					</div>
<?php endif; ?>
				</main>
