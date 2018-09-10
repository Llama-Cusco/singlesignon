<?php


namespace Itratos\SingleSignOn\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;


define("TOOLKIT_PATH", '/home/llama/projects/oxid6/vendor/onelogin/php-saml/');
require_once(TOOLKIT_PATH . '_toolkit_loader.php');   // We load the SAML2 lib
require_once __DIR__ . '/../Helper/SSOSamlHelper.php';


class SSOLoginController extends FrontendController
{

    public function init()
    {

        parent::init();

        //add user oxid and oxusername(email) to relaystate? for redirect

        try {

            $aSettings = \SSOSamlHelper::getSettings();
            $auth = new \OneLogin_Saml2_Auth($aSettings); // Constructor of the SP, loads settings.php

            $sRedirectUrl = $this->getConfig()->getShopUrl();
            if($sRetUrl = $this->getConfig()->getRequestParameter('returnUrl')) {
                $sRedirectUrl .= $sRetUrl;
            }

            $auth->login(serialize(array(
                'redirectUrl' => $sRedirectUrl
            )));

        } catch (\OneLogin_Saml2_Error $e) {
            throw $e;
        }
    }

}