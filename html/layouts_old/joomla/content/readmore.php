<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$params = $displayData['params'];
$item = $displayData['item'];
?>

<p class="readmore">
	<a class="btn btn-default" href="<?php echo $displayData['link']; ?>" itemprop="url">
		<i class="glyphicon glyphicon-chevron-right"></i> 
		<?php if (!$params->get('access-view')) :
			echo Text::_('JGLOBAL_REGISTER_TO_READ_MORE');
		elseif ($readmore = $item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo HTMLHelper::_('string.truncate', ($item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo Text::_('JGLOBAL_READ_MORE_TITLE');            
		else :
			echo Text::_('JGLOBAL_READ_MORE');
			echo HTMLHelper::_('string.truncate', ($item->title), $params->get('readmore_limit'));
		endif; ?>
	</a>
</p>
