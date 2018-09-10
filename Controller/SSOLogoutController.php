<?php


namespace Itratos\SingleSignOn\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;


define("TOOLKIT_PATH", '/home/llama/projects/oxid6/vendor/onelogin/php-saml/');
require_once(TOOLKIT_PATH . '_toolkit_loader.php');   // We load the SAML2 lib
require_once __DIR__ . '/../Helper/SSOSamlHelper.php';


class SSOLogoutController extends FrontendController
{

//    public function init()
//    {
//        $sSamlResponse = $this->getConfig()->getRequestParameter('SAMLResponse');
//
//        if($sSamlResponse === null) return;
//        $aSettings = \SSOSamlHelper::getSettings();
//
//        $SAMLSettings = new \OneLogin_Saml2_Settings($aSettings);
//        $samlResponse = new \OneLogin_Saml2_Response($SAMLSettings, $sSamlResponse);
//
//
//    }

}