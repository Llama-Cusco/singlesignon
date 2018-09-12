<?php

namespace Itratos\SingleSignOn\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;


require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/includes.php';


class SSOLogoutController extends FrontendController
{

    public function init()
    {
        try {

            $oUser = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
            $oUser->logout();

        } catch (OneLogin_Saml2_Error $e) {

        }
    }

}