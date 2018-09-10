<?php
/**
 * This file is part of OXID eSales WYSIWYG module.
 *
 * OXID eSales WYSIWYG module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales WYSIWYG module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales WYSIWYG module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2017
 * @version   OXID eSales WYSIWYG
 */

use \OxidEsales\Eshop\Application\Component\UserComponent;
use \Itratos\SingleSignOn\Component\SSOUserComponent;
use \Itratos\SingleSignOn\Controller\SSOAcsController;
use \Itratos\SingleSignOn\Controller\SSOLoginController;


/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id'          => 'singlesignon',
    'title'       => 'SAML single sign-on',
    'description' => array(
        'de' => '',
        'en' => '',
    ),
    'thumbnail'   => 'logo.png',
    'version'     => '1.0',
    'author'      => 'Itratos Limited & Co. KG',
    'url'         => 'http://www.itratos.de',
    'email'       => 'support@itratos.de',
    'extend'      => array(
        // Component
        UserComponent::class => SSOUserComponent::class


    ),
    'controllers'       => array(
        'SSOAcsController' => SSOAcsController::class,
        'SSOLoginController' => SSOLoginController::class
    ),
    'templates'   => array(

    ),
    'events'      => array(

    ),
    'blocks'      => array(
        array(
            'template' => 'widget/header/loginbox.tpl',
            'block'    => 'thirdparty_login',
            'file'     => 'views/blocks/thirdparty_login.tpl'
        )
    ),
    'settings'    => array()
);
