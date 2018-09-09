<?php


namespace Itratos\SingleSignOn\Component;

define("TOOLKIT_PATH", '/home/llama/projects/oxid6/vendor/onelogin/php-saml/');
require_once(TOOLKIT_PATH . '_toolkit_loader.php');   // We load the SAML2 lib
require_once __DIR__ . '/../Helper/SSOSamlHelper.php';

class SSOUserComponent extends SSOUserComponent_parent
{

    /**
     * Special utility function which is executed right after
     * oxcmp_user::logout is called. Currently it unsets such
     * session parameters as user chosen payment id, delivery
     * address id, active delivery set.
     */
    protected function _afterLogout()
    {
        parent::_afterLogout();

        try {

            $sRedirectUrl = $this->getConfig()->getShopUrl();
            if($sRetUrl = $this->getConfig()->getRequestParameter('returnUrl')) {
                $sRedirectUrl .= $sRetUrl;
            }

            $aSettings = \SSOSamlHelper::getSettingsArray();
            $auth = new \OneLogin_Saml2_Auth($aSettings); // Constructor of the SP, loads settings.php
            $auth->logout(serialize(array(
                'redirectUrl' => $sRedirectUrl
            )));
        } catch (OneLogin_Saml2_Error $e) {

        }
    }

//    public function login()
//    {
//
//        $sUser = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter('lgn_usr');
//        $sPassword = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter('lgn_pwd', true);
//        $sCookie = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter('lgn_cook');
//
//        $this->setLoginStatus(USER_LOGIN_FAIL);
//
//        // trying to login user
//        try {
//            /** @var \OxidEsales\Eshop\Application\Model\User $oUser */
//            $oUser = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
//            $oUser->login($sUser, $sPassword, $sCookie);
//            $this->setLoginStatus(USER_LOGIN_SUCCESS);
//        } catch (\OxidEsales\Eshop\Core\Exception\UserException $oEx) {
//            // for login component send excpetion text to a custom component (if defined)
//            \OxidEsales\Eshop\Core\Registry::getUtilsView()->addErrorToDisplay($oEx, false, true, '', false);
//
//            return 'user';
//        } catch (\OxidEsales\Eshop\Core\Exception\CookieException $oEx) {
//            \OxidEsales\Eshop\Core\Registry::getUtilsView()->addErrorToDisplay($oEx);
//
//            return 'user';
//        }
//
//        //added login to IdP
//        $oUser = $this->getUser();
//        if(!$oUser) return;
//
//        //add user oxid and oxusername(email) to relaystate? for redirect
//
//        try {
//
//            $aSettings = \SSOSamlHelper::getSettingsArray();
//            $auth = new \OneLogin_Saml2_Auth($aSettings); // Constructor of the SP, loads settings.php
//            $auth->login(serialize(array(
//                'redirectUrl' => $this->getRedirectUrl()
//            )));
//
//        } catch (\OneLogin_Saml2_Error $e) {
//            throw $e;
//        }
//
//        // finalizing ..
//        return $this->_afterLogin($oUser);
//    }


//    private function getRedirectUrl()
//    {
//        $headers = getallheaders();
//        $size = count($headers);
//        for ($i = $size - 1; $i >= 0; $i--) {
//            if ($headers[$i]['name'] == 'Location') {
//                return $headers[$i]['value'];
//            }
//        }
//
//        return false;
//    }

}