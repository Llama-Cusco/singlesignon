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

        if(!$sSamlResponse) {
            throw new Exception('Empty SAML response.');
        };

        $aSettings = \SSOSamlHelper::getSettings();

        $SAMLSettings = new \OneLogin_Saml2_Settings($aSettings);
        $samlResponse = new \OneLogin_Saml2_Response($SAMLSettings, $sSamlResponse);

        try {

            if (!$samlResponse->isValid() ) {
                throw new Exception('Invalid SAML response.');
            }

            $assertionAttributes = $samlResponse->getAttributes();

            echo '<pre>';
            print_r($assertionAttributes);
            echo '</pre>';
            die();

/*          array(7) {
                ["mandator"]=> array(1) {
                    [0]=> string(2) "89"
                }
                ["firstname"]=> array(1) {
                    [0]=> string(0) ""
                } ["ident"]=> array(1) {
                    [0]=> string(4) "1092"
                }
                ["roles"]=> array(1) {
                    [0]=> string(7) "FILIALE"
                } ["login"]=> array(1) {
                    [0]=> string(10) "itratossso"
                } ["type"]=> array(1) {
                    [0]=> string(1) "9"
                }
                ["lastname"]=> array(1) {
                    [0]=> string(16) "Itratos SSO-Test"
                }
            }*/

            $this->handleIdpLoginResponse($assertionAttributes, $redirect);

        } catch (Exception $e) {
            Registry::getUtils()->redirect( $this->getConfig()->getShopUrl() );
        }
    }


    private function handleIdpLoginResponse($assertionAttributes, $redirect) {

        //$email = isset($assertionAttributes['oxusername'])? $assertionAttributes['oxusername'][0] : '';
        $login = isset($assertionAttributes['login']) ? $assertionAttributes['login'][0] : '';
        if (!$login) {
            throw new Exception("Missing login from saml response");
        }

        //get user by email
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();
        $sQ = 'select oxid from oxuser where oxusername = ' . $oDb->quote($login) . ' AND oxactive = 1';
        $sUserOxid = $oDb->getOne($sQ);

        if(!$sUserOxid) {
            $sUserOxid = $this->createUser($login);
        }

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

            Registry::getUtils()->redirect( $redirect );
        }

        Registry::getUtils()->redirect( $this->getConfig()->getShopUrl()  );
    }


    private function createUser($login) {
        try {
            /** @var \OxidEsales\Eshop\Application\Model\User $oUser */
            $oUser = oxNew(\OxidEsales\Eshop\Application\Model\User::class);

            // setting values
            $oUser->oxuser__oxusername = new \OxidEsales\Eshop\Core\Field($login, \OxidEsales\Eshop\Core\Field::T_RAW);

            $sPassword = $this->createDummyPassword($login);

            $oUser->setPassword($sPassword);
            $oUser->oxuser__oxactive = new \OxidEsales\Eshop\Core\Field(1, \OxidEsales\Eshop\Core\Field::T_RAW);


            $database = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();
            $database->startTransaction();

            try {
                $oUser->createUser();
                $database->commitTransaction();
                return $oUser->getId();

            } catch (Exception $exception) {
                $database->rollbackTransaction();
                throw $exception;
            }
        }
        catch (\OxidEsales\Eshop\Core\Exception\UserException $exception) {
                Registry::getUtilsView()->addErrorToDisplay($exception, false, true);
                return false;
        }
    }


    private function createDummyPassword($login) {
        return $login . '_' . $this->getConfig()->getShopUrl();
    }

}