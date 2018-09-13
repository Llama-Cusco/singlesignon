<?php


namespace Itratos\SingleSignOn\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Registry;


require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/includes.php';


class SSOAcsController extends FrontendController
{

    public function init()
    {
        parent::init();

        //$redirect = $this->getConfig()->getRequestParameter('RelayState');
        //if (!$redirect) {
            $redirect = $this->getConfig()->getShopUrl();
        //}

        $sSamlResponse = $this->getConfig()->getRequestParameter('SAMLResponse');

        var_dump($sSamlResponse);

        if(!$sSamlResponse) {
            throw new Exception('Empty SAML response.');
        };

        $aSettings = \SSOSamlHelper::getSettings();
        $SAMLSettings = new \OneLogin_Saml2_Settings($aSettings);
        $samlResponse = new \OneLogin_Saml2_Response($SAMLSettings, $sSamlResponse);

        var_dump($aSettings, $sSamlResponse);

        try {
            if (!$samlResponse->isValid() ) {
                throw new Exception('Invalid SAML response.');
            }

            $assertionAttributes = $samlResponse->getAttributes();
            $this->handleIdpLoginResponse($assertionAttributes, $redirect);

        } catch (Exception $e) {
            Registry::getUtils()->redirect( $this->getConfig()->getShopUrl() );
        }
    }


    private function handleIdpLoginResponse($assertionAttributes, $redirect) {

        $email = isset($assertionAttributes['oxusername'])? $assertionAttributes['oxusername'][0] : '';
        if (!$email) {
            throw new Exception("Missing email from saml response");
        }

        //get user by email
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();
        $sQ = 'select oxid from oxuser where oxusername = ' . $oDb->quote($email) . ' AND oxactive = 1';
        $sUserOxid = $oDb->getOne($sQ);

        if ($sUserOxid) {
            //login oxid customer in session
            $this->setUser(null);
            if ($this->isAdmin()) {
                Registry::getSession()->setVariable('auth', $sUserOxid);
            } else {
                Registry::getSession()->setVariable('usr', $sUserOxid);
            }

            //todo: afterlogin
            //$this->_afterLogin($oUser);

            Registry::getUtils()->redirect( $redirect  );
        }

        Registry::getUtils()->redirect( $this->getConfig()->getShopUrl()  );
    }

}