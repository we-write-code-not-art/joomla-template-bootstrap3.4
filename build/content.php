		<div class="content content-pane">
			<div class="row">
<?php 
  if ($hasSidebarLeft) : 
    include "content-sidebar-left.php";
  endif;

  if ($hasFeatured) : ?>
			<div class="featured hidden-xs col-lg-12">
				<jdoc:include type="modules" name="featured" style="none" />
			</div>
<?php 
  endif;
  
  include "content-main.php";

  if ($hasSidebarRight) : 
    include "content-sidebar-right.php";
  endif;

?>
			</div>
		</div>
