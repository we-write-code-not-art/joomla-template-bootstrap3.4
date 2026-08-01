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

use Joomla\CMS\Helper\ModuleHelper;

if (!$categoryNode) {
    return;
}

//$hasWeblinks = !empty($categoryNode->weblinks);
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

$selectedCategories = (array) $params->get('catid', []);

// check if the "Show Parent Category" option is turned off
$hideParent = !$params->get('show_parent_category', 0);

// a category is a root if it's selected and its parent is not
//$parent = $categoryNode->category->getParent();
//echo "<pre>9 parent id ".$parent->id."</pre>";

//$isCurrentSelected = in_array($categoryNode->category->id, $selectedCategories);
//$isParentSelected = in_array($parent->id, $selectedCategories);

//$isRootCategory = $isCurrentSelected && !$isParentSelected;
//echo "<pre>9 hide ".$hideParent."</pre>";
//echo "<pre>9 current ".$isCurrentSelected."</pre>";
//echo "<pre>9 parent ".$isParentSelected."</pre>";

// We should skip rendering the content of this category if it's the root and the "hide parent" option is on
//$skipContent = $isRootCategory && $hideParent;
$links = [];
//echo "<pre>9 skip ".$skipContent."</pre>";

if (!function_exists('flatten')) {
  function flatten($categories, &$links)
  {
    foreach ($categories->children as $category)
    {
      if (!empty($category->weblinks))
      {
        foreach ($category->weblinks as $link)
        {
          $link->category = $category->category;
          $links[] = $link;
        }
      }

      if (!empty($category->children))
      {
        foreach ($category->children as $child)
        {
          flatten($child, $links);
        }
      }
    }
  }
}

flatten($categoryNode, $weblinks);

usort($weblinks, function ($a, $b) {
    return strtotime($b->created) <=> strtotime($a->created);
});

$weblinks = array_slice($weblinks, 0, $params->get('count', 0));
$hasWeblinks = !empty($weblinks);


// a category is a root if it's selected and its parent is not
$parent = $categoryNode->category->getParent();

$isCurrentSelected = in_array($categoryNode->category->id, $selectedCategories);
$isParentSelected = in_array($parent->id, $selectedCategories);

$isRootCategory = $isCurrentSelected && !$isParentSelected;
$skipContent = $isRootCategory && $hideParent;

//$categoryNode = $links;
$categoryNodeTitle = $categoryNode->category->title .'xxx';


//if ($hasWeblinks && !$skipContent) {
//  foreach ($categoryNode->children as $child) {
//    $originalCategoryNode = $categoryNode;
//    $categoryNode = $child;
//    require ModuleHelper::getLayoutPath('mod_weblinks', $params->get('layout', 'default') . '_category');
//    $categoryNode = $originalCategoryNode;
//  }
//}

// Render the category content only if it has weblinks and we are not skipping it
//if ($hasWeblinks && !$skipContent) {
if ($hasWeblinks) {
    $cssClass = 'weblinks-category';
    $cssClass = 'weblinks';

    // Echo the opening tag BEFORE processing children.
    //echo '<div class="' . $cssClass . '">';
    //echo "<ul class='weblinks ". $moduleclass_sfx . "'>";
    echo '<ul class="' . $cssClass . '">';

    //if ($params->get('groupby_showtitle', 1)) {
    //    $categoryNodeTitle = $categoryNode->category->title;
    //    echo '<strong>' . htmlspecialchars($categoryNodeTitle, ENT_COMPAT, 'UTF-8') . '</strong>';
    //}
    //require ModuleHelper::getLayoutPath('mod_weblinks', $params->get('layout', 'default') . '_items');

    require ModuleHelper::getLayoutPath('mod_weblinks', $params->get('layout', 'default') . '_items');

    // Now, process any children so they are nested inside the parent.
//    foreach ($categoryNode->children as $child) {
//        $originalCategoryNode = $categoryNode;
//        $categoryNode = $child;
//        require ModuleHelper::getLayoutPath('mod_weblinks', $params->get('layout', 'default') . '_category');
//        $categoryNode = $originalCategoryNode;
//    }

    echo '</ul>';
//} else {
    // If the category has no weblinks, don't render it.
    // But, we process its children to see if they have weblinks.
//    foreach ($categoryNode->children as $child) {
//        $originalCategoryNode = $categoryNode;
//        $categoryNode = $child;
//        require ModuleHelper::getLayoutPath('mod_weblinks', $params->get('layout', 'default') . '_category');
//        $categoryNode = $originalCategoryNode;
//    }
}

