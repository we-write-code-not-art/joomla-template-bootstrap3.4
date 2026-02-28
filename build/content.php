		<div class="content content-pane">
			<div class="row">
<?php 
  if ($hasSidebarLeft) : 
    include "content-sidebar-left.php";
  endif;

  include "content-main.php";

  if ($hasSidebarRight) : 
    include "content-sidebar-right.php";
  endif;

?>
			</div>
		</div>
