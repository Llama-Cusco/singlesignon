<?php


namespace Itratos\SingleSignOn\Component;

define("TOOLKIT_PATH", '/home/llama/projects/oxid6/vendor/onelogin/php-saml/');
require_once(TOOLKIT_PATH . '_toolkit_loader.php');   // We load the SAML2 lib
require_once __DIR__ . '/../Helper/SSOSamlHelper.php';

class SSOUserComponent extends SSOUserComponent_parent
{


    public function login()
    {

        $aSettings = \SSOSamlHelper::getSettingsArray();

        $auth = new \OneLogin_Saml2_Auth($aSettings); // Constructor of the SP, loads settings.php
        $auth->login('http://oxid6/source/llamatest');


        $sUser = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter('lgn_usr');
        $sPassword = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter('lgn_pwd', true);
        $sCookie = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter('lgn_cook');

        $this->setLoginStatus(USER_LOGIN_FAIL);

        // trying to login user
        try {
            /** @var \OxidEsales\Eshop\Application\Model\User $oUser */
            $oUser = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
            $oUser->login($sUser, $sPassword, $sCookie);
            $this->setLoginStatus(USER_LOGIN_SUCCESS);
        } catch (\OxidEsales\Eshop\Core\Exception\UserException $oEx) {
            // for login component send exception text to a custom component (if defined)
            \OxidEsales\Eshop\Core\Registry::getUtilsView()->addErrorToDisplay($oEx, false, true, '', false);

            return 'user';
        } catch (\OxidEsales\Eshop\Core\Exception\CookieException $oEx) {
            \OxidEsales\Eshop\Core\Registry::getUtilsView()->addErrorToDisplay($oEx);

            return 'user';
        }

        // finalizing ..
        return $this->_afterLogin($oUser);
    }

    public function login_noredirect()
    {
        parent::login_noredirect();

        Registry::getSession()->setVariable("iShowSteps", 1);
        $oViewConfig = oxNew(ViewConfig::class);
        if ($oViewConfig->isKlarnaCheckoutEnabled()) {
            KlarnaUtils::fullyResetKlarnaSession();
            Registry::getSession()->deleteVariable('oFakeKlarnaUser');
            Registry::getSession()->deleteVariable('sFakeUserId');
            if ($this->klarnaRedirect()) {
                Registry::getUtils()->redirect(
                    $this->getConfig()->getShopSecureHomeUrl() . 'cl=KlarnaExpress',
                    false,
                    302
                );
            }
        }
        if ($oViewConfig->isKlarnaPaymentsEnabled()) {
            KlarnaPayment::cleanUpSession();
        }
    }

}