<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   (C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

?>
<?php foreach ($items as $item) : ?>
<?php $images = json_decode($item->images); ?>
<li style="display: inline-block;">
    <div class="media">
        <div class="media-left">
          <?php $attributes = ['class' => 'media-object article-thumb ' . $item->active,
                               'alt'      => $images->image_intro_alt ?? '',
                               'title'    => $images->image_intro_caption ?? '',
                               'loading'  => 'lazy', // Joomla handles native lazy loading automatically
                               'itemprop' => 'image'
          ]; ?>

          <?php $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false); ?>
          <?php echo HTMLHelper::_('link', $link, '', $attributes); ?>

          <a href="<?php echo $link; ?>" itemprop="url">
              <?php echo HTMLHelper::_('image', $images->image_intro, $attribs['alt'], $attribs, false); ?>
          </a>

        </div>
        <div class="media-body">
    <?php if ($params->get('link_titles') == 1) : ?>
        <?php $attributes = ['class' => 'mod-articles-category-title ' . $item->active]; ?>
        <?php $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false); ?>
        <?php $title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false); ?>
        <?php echo HTMLHelper::_('link', $link, $title, $attributes); ?>
    <?php else : ?>
        <?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>
    <?php endif; ?>

        <div>
    <?php if ($item->displayDate) : ?>
        <span class="mod-articles-category-date"><?php echo htmlspecialchars($item->displayDate, ENT_COMPAT, 'UTF-8'); ?></span>
    <?php endif; ?>

    <?php if ($item->displayCategoryTitle) : ?>
        <!--div class="mod-articles-category-category"-->
<?php if (!empty($item->catid) && !empty($item->category_title)) : ?>
    <?php 

    // Generate the SEF route to this specific article's child category
    $childCatLink = Route::_(RouteHelper::getCategoryRoute($item->catid));
    ?>
     · 
    <span class="article-child-category">
        <a href="<?php echo $childCatLink; ?>"><?php echo htmlspecialchars($item->category_title); ?></a>
    </span>
<?php endif; ?>
        
        <!--/div-->
    <?php endif; ?>
        </div>

        </div>


    </div>
</li>
<?php endforeach; ?>
