				<main role="main" class="main-content <?php echo $middle_column; ?>">
<?php if ($mainContentInWell) : ?>
					<div class="panel">
						<div class="panel-body">
<?php endif; ?>
						<jdoc:include type="message" />
						<jdoc:include type="modules" name="content-header" style="none" />
						<jdoc:include type="component" />
						<jdoc:include type="modules" name="content-footer" style="none" />
<?php if ($mainContentInWell) : ?>
						</div>
					</div>
<?php endif; ?>
				</main>
