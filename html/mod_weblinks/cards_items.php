<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  Weblinks
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\Weblinks\Site\Helper\RouteHelper;

if (empty($weblinks)) {
    return;
}

if (!function_exists('safe_dump')) {
  function safe_dump($data, $maxDepth = 5, $currentDepth = 0, &$seen = []) {
      // 1. Memory Guard: Stop if we go too deep
      if ($currentDepth >= $maxDepth) {
          echo str_repeat("  ", $currentDepth) . "*MAX DEPTH REACHED*\n";
          return;
      }

      // 2. Circular Reference Guard: Track objects and arrays
      if (is_object($data) || is_array($data)) {
          $id = is_object($data) ? spl_object_hash($data) : serialize($data);
          if (in_array($id, $seen, true)) {
              echo str_repeat("  ", $currentDepth) . "*CIRCULAR REFERENCE DETECTED*\n";
              return;
          }
          $seen[] = $id;
      }

      // 3. Safe Printing
      if (is_array($data)) {
          echo "Array (\n";
          foreach ($data as $key => $value) {
              echo str_repeat("  ", $currentDepth + 1) . "[$key] => ";
              safe_dump($value, $maxDepth, $currentDepth + 1, $seen);
          }
          echo str_repeat("  ", $currentDepth) . ")\n";
      } elseif (is_object($data)) {
          echo get_class($data) . " Object (\n";
          foreach ((array)$data as $key => $value) {
              echo str_repeat("  ", $currentDepth + 1) . "->$key = ";
              safe_dump($value, $maxDepth, $currentDepth + 1, $seen);
          }
          echo str_repeat("  ", $currentDepth) . ")\n";
      } else {
          var_dump($data);
      }
  }
}
?>

    <?php foreach ($weblinks as $item) : ?>
      <?php $images = json_decode($item->images); ?>
      <li style="display: inline-block;">
        <div class="media">
          <div class="media-left">
            <?php $imageUrl = htmlspecialchars($images->image_first); ?>
            <?php $attributes = ['class' => 'media-object article-thumb ' . $item->active,
                                 'alt'      => $images->image_first_alt ?? '',
                                 'title'    => $images->image_first_caption ?? '',
                                 'loading'  => 'lazy', // Joomla handles native lazy loading automatically
                                 'itemprop' => 'image'
                                ]; 
            ?>

            <?php $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false); ?>
            <a href="<?php echo $link; ?>" itemprop="url">
              <?php echo HTMLHelper::_('image', $images->image_first, $attribs['alt'], $attribs, false); ?>
            </a>
          </div>

          <div class="media-body">
            <?php $attributes = ['class' => 'mod-articles-category-title ' . $item->active]; ?>
            <?php $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false); ?>
            <?php $title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false); ?>
            <?php echo HTMLHelper::_('link', $link, $title, $attributes); ?>

            <div>
              <?php if ($item->created) : ?>
                <span class="mod-articles-category-date"><?php echo htmlspecialchars(date_format(date_create($item->created), 'F d, Y'), ENT_COMPAT, 'UTF-8'); ?></span>
              <?php endif; ?>

                <!--div class="mod-articles-category-category"-->
                <?php if (!empty($item->category->id) && !empty($item->category->title)) : ?>
                  <?php 
                    // Generate the SEF route to this specific article's child category
                    $childCatLink = Route::_(RouteHelper::getCategoryRoute($item->category->id));                   
                  ?>
                   · 
                  <span class="article-child-category">
                    <a href="<?php echo $childCatLink; ?>"><?php echo htmlspecialchars($item->category->title); ?></a>
                  </span>
                <?php endif; ?>
        
                <!--/div-->
            </div>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
