<?php

/**
 * This file is part of the FlexShop package.
 *
 * @author (c) Peter Thiel <thiel.peter@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FlexShop;

$csrfToken = \rex_csrf_token::factory('flexshop-settings');

$sections = '';

if (rex_post('config-submit', 'boolean')) {
    $this->setConfig(rex_post('settings', [
        ['redirect_article', 'int'],
        ['cart_article', 'int'],
        ['vat', 'int'],
        ['currency', 'string'],
        ['shipping', 'int'],
        ['free_shipping', 'int'],
        ['send_invoice', 'boolean'],
        ['payments_enabled', 'boolean'],
    ]));

    // echo rex_view::success($this->i18n('saved'));
}

// - - - - - - - - - - - - - - - - - - - - - - Wildcard
$panelElements = '';
$formElements = [];
$n = [];
$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="redirect-article">'.$this->i18n('settings_redirect_article').'</label>';
$n['field'] = '
    <div class="input-group">
        <input class="form-control" type="text" id="redirect-article" name="settings[redirect_article]" value="'.htmlspecialchars($this->getConfig('redirect_article')).'" placeholder="'.$this->i18n('settings_article_id').'" />
    </div>';
$formElements[] = $n;

$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="cart-article">'.$this->i18n('settings_cart_article').'</label>';
$n['field'] = '
    <div class="input-group">
        <input class="form-control" type="text" id="cart-article" name="settings[cart_article]" value="'.htmlspecialchars($this->getConfig('cart_article')).'" placeholder="'.$this->i18n('settings_article_id').'" />
    </div>';
$formElements[] = $n;

$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="vat">'.$this->i18n('settings_vat').'</label>';
$n['field'] = '
    <div class="input-group">
        <input class="form-control" type="text" id="vat" name="settings[vat]" value="'.htmlspecialchars($this->getConfig('vat')).'" placeholder="'.$this->i18n('settings_vat').'" />
    </div>';
$formElements[] = $n;

$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="currency">'.$this->i18n('settings_currency').'</label>';
$n['field'] = '
    <div class="input-group">
        <input class="form-control" type="text" id="currency" name="settings[currency]" value="'.htmlspecialchars($this->getConfig('currency')).'" placeholder="'.$this->i18n('settings_currency').'" />
    </div>';
$formElements[] = $n;

$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="shipping">'.$this->i18n('settings_shipping').'</label>';
$n['field'] = '
    <div class="input-group">
        <input class="form-control" type="text" id="shipping" name="settings[shipping]" value="'.htmlspecialchars($this->getConfig('shipping')).'" placeholder="'.$this->i18n('settings_shipping').'" />
    </div>';
$formElements[] = $n;

$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="free_shipping">'.$this->i18n('settings_free_shipping').'</label>';
$n['field'] = '
    <div class="input-group">
        <input class="form-control" type="text" id="free_shipping" name="settings[free_shipping]" value="'.htmlspecialchars($this->getConfig('free_shipping')).'" placeholder="'.$this->i18n('settings_free_shipping').'" />
    </div>';
$formElements[] = $n;

$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="send_invoice">'.$this->i18n('settings_send_invoice').'</label>';
$n['field'] = '
    <div class="input-group">
        <input type="checkbox" id="send_invoice" name="settings[send_invoice]" value="1" ' . ($this->getConfig('send_invoice') ? ' checked="checked"' : '') . ' />
    </div>';
$formElements[] = $n;

$n['header'] = '<div class="row"><div class="col-lg-8">';
$n['footer'] = '</div></div>';
$n['label'] = '<label for="payments_enabled">'.$this->i18n('settings_payments_enabled').'</label>';
$n['field'] = '
    <div class="input-group">
        <input type="checkbox" id="payments_enabled" name="settings[payments_enabled]" value="1" ' . ($this->getConfig('payments_enabled') ? ' checked="checked"' : '') . ' />
    </div>';
$formElements[] = $n;

$fragment = new \rex_fragment();
$fragment->setVar('elements', $formElements, false);
$grid[] = $fragment->parse('core/form/form.php');

$fragment = new \rex_fragment();
$fragment->setVar('content', $grid, false);
$panelElements .= $fragment->parse('core/page/grid.php');

$panelElements .= '</fieldset>';

$fragment = new \rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $this->i18n('settings_title'), false);
$fragment->setVar('body', $panelElements, false);
$sections .= $fragment->parse('core/page/section.php');

$formElements = [];
$n = [];
$n['field'] = '<a class="btn btn-abort" href="'.\rex_url::currentBackendPage().'">'.\rex_i18n::msg('form_abort').'</a>';
$formElements[] = $n;

$n = [];
$n['field'] = '<button class="btn btn-apply rex-form-aligned" type="submit" name="config-submit" value="1"'.\rex::getAccesskey(\rex_i18n::msg('update'), 'apply').'>'.\rex_i18n::msg('update').'</button>';
$formElements[] = $n;

$fragment = new \rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');

$fragment = new \rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('buttons', $buttons, false);
$sections .= $fragment->parse('core/page/section.php');

echo '
    <form action="'.\rex_url::currentBackendPage().'" method="post">
        '.$sections.'
    </form>
';
