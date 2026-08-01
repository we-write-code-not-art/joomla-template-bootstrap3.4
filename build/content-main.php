				<main role="main" class="main-content <?php echo $middle_column; ?>">
<?php if ($mainContentInWell) : ?>
					<div class="panel">
						<div class="panel-body">
<?php endif; ?>
						<jdoc:include type="message" />
            <div class="content-header">
              <jdoc:include type="modules" name="content-header" />
            </div>
						<jdoc:include type="component" />
            <div class="content-footer">
              <jdoc:include type="modules" name="content-footer"/>
            </div>
<?php if ($mainContentInWell) : ?>
						</div>
					</div>
<?php endif; ?>
				</main>
