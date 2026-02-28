<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

/** @var \Joomla\Component\Users\Site\View\Login\HtmlView $this */

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->getDocument()->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$usersConfig = ComponentHelper::getParams('com_users');

?>
<!--<div class="panel">
<div class="panel-body">-->

<div class="com-users-login login">
    <?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1>
            <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    </div>
    <?php endif; ?>

    <?php if (($this->params->get('logindescription_show') == 1 && trim($this->params->get('login_description', ''))) || $this->params->get('login_image') != '') : ?>
    <div class="com-users-login__description login-description">
    <?php endif; ?>

        <?php if ($this->params->get('logindescription_show') == 1) : ?>
            <?php echo $this->params->get('login_description'); ?>
        <?php endif; ?>

        <div class="media">
        <div class="media-body">
        <?php if ($this->params->get('login_image') != '') : ?>
            <?php echo HTMLHelper::_('image', $this->params->get('login_image'), empty($this->params->get('login_image_alt')) && empty($this->params->get('login_image_alt_empty')) ? false : $this->params->get('login_image_alt'), ['class' => 'com-users-login__image login-image']); ?>
        <?php endif; ?>
        </div>
        </div>
        
    <?php if (($this->params->get('logindescription_show') == 1 && trim($this->params->get('login_description', ''))) || $this->params->get('login_image') != '') : ?>
    </div>
    <?php endif; ?>

<div class="row well">
<div class="col-md-4 col-md-offset-4">


    <form action="<?php echo Route::_('index.php?task=user.login'); ?>" method="post" id="com-users-login__form" class="com-users-login__form form-validate form-horizontal">

        <fieldset>
<div class="mb-3">

    <?php echo $this->form->getLabel('username'); ?>

    <div class="input-group">
        <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="16"
                 height="16"
                 fill="currentColor"
                 viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
        </span>

        <?php echo $this->form->getInput('username'); ?>
    </div>

</div>

<div class="mb-3">

    <?php echo $this->form->getLabel('password'); ?>

    <div class="input-group">
        <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="16"
                 height="16"
                 fill="currentColor"
                 viewBox="0 0 16 16">
                <path d="M8 1a4 4 0 0 0-4 4v3H3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-1V5a4 4 0 0 0-4-4zm-2 7V5a2 2 0 1 1 4 0v3H6z"/>
            </svg>
        </span>

        <?php echo $this->form->getInput('password'); ?>
    </div>

</div>

            <?php if (PluginHelper::isEnabled('system', 'remember')) : ?>
                <div class="com-users-login__remember">
                    <div class="form-check">
                        <input class="form-check-input" id="remember" type="checkbox" name="remember" value="yes">
                        <label class="form-check-label" for="remember">
                            <?php echo Text::_('COM_USERS_LOGIN_REMEMBER_ME'); ?>
                        </label>
                    </div>
                </div>
            <?php endif; ?>

            <?php foreach ($this->extraButtons as $button) :
                $dataAttributeKeys = array_filter(array_keys($button), function ($key) {
                    return substr($key, 0, 5) == 'data-';
                });
                ?>
                <div class="com-users-login__submit control-group list-group">
                    <div class="controls">
                        <button type="button"
                                class="btn flist-group-item btn-secondary w-100 <?php echo $button['class'] ?? '' ?>"
                                <?php foreach ($dataAttributeKeys as $key) : ?>
                                    <?php echo $key ?>="<?php echo $button[$key] ?>"
                                <?php endforeach; ?>
                                <?php if ($button['onclick']) : ?>
                                onclick="<?php echo $button['onclick'] ?>"
                                <?php endif; ?>
                                title="<?php echo Text::_($button['label']) ?>"
                                id="<?php echo $button['id'] ?>"
                        >
                            <?php if (!empty($button['icon'])) : ?>
                                <span class="<?php echo $button['icon'] ?>"></span>
                            <?php elseif (!empty($button['image'])) : ?>
                                <?php echo HTMLHelper::_('image', $button['image'], Text::_($button['tooltip'] ?? ''), [
                                    'class' => 'icon',
                                ], true) ?>
                            <?php elseif (!empty($button['svg'])) : ?>
                                <?php echo $button['svg']; ?>
                            <?php endif; ?>
                            <?php echo Text::_($button['label']) ?>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="com-users-login__submit control-group list-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">
                        <?php echo Text::_('JLOGIN'); ?>
                    </button>
                </div>
            </div>

            <?php echo $this->form->renderControlFields(); ?>
        </fieldset>
    </form>
    <div class="com-users-login__options list-group text-center">
        <div>
        <a class="com-users-login__reset" href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>">
            <?php echo Text::_('COM_USERS_LOGIN_RESET'); ?>
        </a>
        </div>
        <div>
        <a class="com-users-login__remind" href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>">
            <?php echo Text::_('COM_USERS_LOGIN_REMIND'); ?>
        </a>
        </div>
        <?php
        if ($usersConfig->get('allowUserRegistration')) :
            $regLinkMenuId = $this->params->get('customRegLinkMenu');
            $regLink = 'index.php?option=com_users&view=registration';

            if ($regLinkMenuId) {
                $menu = Factory::getApplication()->getMenu();
                $item = $menu->getItem($regLinkMenuId);

                if ($item) {
                    $regLink = 'index.php?Itemid=' . $regLinkMenuId;
                }
            }
            ?>
            <a class="com-users-login__register flist-group-item" href="<?php echo Route::_($regLink); ?>">
                <?php echo Text::_('COM_USERS_LOGIN_REGISTER'); ?>
            </a>
        <?php endif; ?>
    </div>
    </div>
    </div>
<!--</div>
</div>-->
