<?php if(!$this->params->get('sidebarLeftHasRoundedCorners')) : ?>
		.sidebar-left .well {
			border-radius: 0;
		}
<?php endif; ?>
<?php if(!$this->params->get('sidebarRightHasRoundedCorners')) : ?>
		.sidebar-right .well {
			border-radius: 0;
		}
<?php endif; ?>

/* Force all sidebar submenu toggles open */
.mod-menu__toggle-sub {
    display: none;
}

.mod-menu .mod-menu__sub,
.mod-menu [id^="mod-menu"][id$="-submenu"] {
    display: block !important;
}

/* Restore indentation for always-visible submenus */
.mod-menu .mod-menu__sub {
    margin-left: 30px;   /* adjust to taste */
    padding-left: 0;
}

.mod-menu .mod-menu__sub li {
    list-style: none;
}

.mod-menu .mod-menu__sub.small {
   font-size: 100%;
}
