<?php use Joomla\CMS\Language\Text; ?>
<?php if ($footerOuterFixedToBottom) : ?>
		<footer class="footer-fixed-bottom navbar-fixed-bottom hidden-xs" >
		</footer>
<?php endif; ?>

		<footer class="footer-outer hidden-xs" >
				<div class="<?php echo $containerFluid; ?>" >
<?php if (($renderModules && $hasFooter) || ($this->debug)): ?>
					<div class="rows">
						<div class="panel footer-inner">
<?php if ($renderModules && $hasFooter) : ?>
              <div class="row">
                <div class="col-md-12 xvisible-lg-block">
                  <jdoc:include type="modules" name="footer" style="none" />
                </div>
              </div>
<?php endif; ?>
<?php if ($this->debug) : ?>
              <div class="row">
                <div class="debug col-md-12 xvisible-lg-block">
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
              </div>
<?php endif; ?>
						</div>
          </div>
<?php endif; ?>

          <div class="row">
            <div class="col-lg-12">
              <p class="pull-right">
                <a href="#top" id="back-top"><?php echo Text::_('Back to top'); ?></a>
              </p>
            </div>
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
