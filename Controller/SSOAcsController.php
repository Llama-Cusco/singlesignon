<?php


namespace Itratos\SingleSignOn\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Registry;


require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/includes.php';

define("SOCOTO_EMAIL_DOMAIN", '@hyundai-merchandising.com');


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
            die('Empty SAML response.');
        };

        $aSettings = \SSOSamlHelper::getSettings();

        $SAMLSettings = new \OneLogin_Saml2_Settings($aSettings);
        $samlResponse = new \OneLogin_Saml2_Response($SAMLSettings, $sSamlResponse);

        try {

            if (!$samlResponse->isValid() ) {
                die('Invalid SAML response.');
            }

            $assertionAttributes = $samlResponse->getAttributes();

//              echo '<pre>';
//              print_r( $assertionAttributes );
//              echo '</pre>';
//              die();

            $this->handleIdpLoginResponse($assertionAttributes, $redirect);

        } catch (Exception $e) {
            Registry::getUtils()->redirect( $this->getConfig()->getShopUrl() );
        }
    }


    private function handleIdpLoginResponse($assertionAttributes, $redirect) {

        $logger = oxNew(\Itratos\SingleSignOn\Core\Logger::class);

        //$email = isset($assertionAttributes['oxusername'])? $assertionAttributes['oxusername'][0] : '';
        $login = isset($assertionAttributes['login']) ? $assertionAttributes['login'][0] : '';
        if (!$login) {
            $logger->setTitle('SAML login error: empty login');
            $logger->log($assertionAttributes);
            die ("Missing login from saml response");
        }

        $login .= SOCOTO_EMAIL_DOMAIN;
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();
        $sQ = 'select oxid from oxuser where oxusername = ' . $oDb->quote($login) . ' AND oxactive = 1';
        $sUserOxid = $oDb->getOne($sQ);

        if(!$sUserOxid) {
            $sUserOxid = $this->createUser($assertionAttributes);

            if(!$sUserOxid) {
                $logger->setTitle('SAML login error: failed to create user');
                $logger->log($assertionAttributes);
            }
        }
        else {
            $this->updateUser($assertionAttributes, $sUserOxid);
        }

        if ($sUserOxid) {
            //login oxid customer in session
            $this->setUser(null);
            if ($this->isAdmin()) {
                Registry::getSession()->setVariable('auth', $sUserOxid);
            } else {
                Registry::getSession()->setVariable('usr', $sUserOxid);
            }

            $logger->setTitle('SAML successful login:');
            $logger->log(array($login, $sUserOxid));

            //todo: afterlogin
            //$this->_afterLogin($oUser);

            Registry::getUtils()->redirect( $redirect );
        }

        $logger->setTitle('SAML login error: empty userid');
        $logger->log('user login: '.$login);

        Registry::getUtils()->redirect( $this->getConfig()->getShopUrl()  );
    }


    private function createUser($aUserData) {
        try {
            /** @var \OxidEsales\Eshop\Application\Model\User $oUser */
            $oUser = oxNew(\OxidEsales\Eshop\Application\Model\User::class);

            $database = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();

            $this->setUserData($oUser, $aUserData);

            $sPassword = $this->createDummyPassword($aUserData['login'][0]);
            $oUser->setPassword($sPassword);

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


    private function setUserData($oUser, $aUserData) {

        $database = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();

        if(preg_match('/^(\D*)\s+([\d|I]+.*)/', $aUserData['customer.street'][0], $m)) {
            $sStreet = $m[1];
            $sStreetNr = $m[2];
        }
        else {
            $sStreet = $aUserData['customer.street'][0];
            $sStreetNr = '';
        }

        // setting values
        $oUser->oxuser__oxurl = new \OxidEsales\Eshop\Core\Field($aUserData['customer.email'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxcompany = new \OxidEsales\Eshop\Core\Field($aUserData['customer.name'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxfon = new \OxidEsales\Eshop\Core\Field($aUserData['customer.phone'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxstreet = new \OxidEsales\Eshop\Core\Field($sStreet, \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxstreetnr = new \OxidEsales\Eshop\Core\Field($sStreetNr, \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxcity = new \OxidEsales\Eshop\Core\Field($aUserData['customer.town'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxzip = new \OxidEsales\Eshop\Core\Field($aUserData['customer.zip'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxcustnr = new \OxidEsales\Eshop\Core\Field((int)$aUserData['ident'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxfname = new \OxidEsales\Eshop\Core\Field($aUserData['firstname'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxlname = new \OxidEsales\Eshop\Core\Field($aUserData['lastname'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxusername = new \OxidEsales\Eshop\Core\Field($aUserData['login'][0] . SOCOTO_EMAIL_DOMAIN, \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxaddinfo = new \OxidEsales\Eshop\Core\Field($aUserData['login'][0], \OxidEsales\Eshop\Core\Field::T_RAW);
        $oUser->oxuser__oxactive = new \OxidEsales\Eshop\Core\Field(1, \OxidEsales\Eshop\Core\Field::T_RAW);

        $sQ = "select oxid from oxcountry where oxisoalpha2 = " . $database->quote( $aUserData['customer.nation'][0] );
        $sCountryID = $database->getOne( $sQ );
        $oUser->oxuser__oxcountryid = new \OxidEsales\Eshop\Core\Field($sCountryID, \OxidEsales\Eshop\Core\Field::T_RAW);
    }

    private function updateUser($aUserData, $sOxid) {
        $oUser = oxNew(\OxidEsales\Eshop\Application\Model\User::class);

        $oUser->load($sOxid);

        $this->setUserData($oUser, $aUserData);

        $oUser->save();
    }


    private function createDummyPassword($login) {
        return $login . '_' . $this->getConfig()->getShopUrl();
    }

}