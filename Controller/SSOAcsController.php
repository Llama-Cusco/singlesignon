<?php
/**
 * Copyright 2018 Klarna AB
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Itratos\SingleSignOn\Controller;

use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

define("TOOLKIT_PATH", '/home/llama/projects/oxid6/vendor/onelogin/php-saml/');
require_once(TOOLKIT_PATH . '_toolkit_loader.php');   // We load the SAML2 lib
require_once __DIR__ . '/../Helper/SSOSamlHelper.php';

class SSOAcsController extends FrontendController
{


    public function init()
    {
        parent::init();

        $redirect = $this->getRedirectUrlFromRelayState($this->getConfig()->getRequestParameter('RelayState'));
        if (!$redirect) {
            $redirect = $this->getConfig()->getShopUrl() . 'index.php?cl=login';
        }

        $sSamlResponse = $this->getConfig()->getRequestParameter('SAMLResponse');

        if($sSamlResponse === null) return;

        $aSettings = \SSOSamlHelper::getSettingsArray();

        $SAMLSettings = new \OneLogin_Saml2_Settings($aSettings);
        $samlResponse = new \OneLogin_Saml2_Response($SAMLSettings, $sSamlResponse);

        try {
            if (!$samlResponse->isValid() ) {
                throw new Exception('Invalid SAML response.');
            }

            $assertionAttributes = $samlResponse->getAttributes();
            $this->handleIdpLoginResponse($assertionAttributes, $redirect);

        } catch (Exception $e) {
            Registry::getUtils()->redirect( $this->getConfig()->getShopUrl() . 'index.php?cl=login' );
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
        $sUserOxid = (int) $oDb->getOne($sQ);

        if ($sUserOxid) {
            //login oxid customer in session
            $this->setUser(null);
            if ($this->isAdmin()) {
                Registry::getSession()->setVariable('auth', $sUserOxid);
            } else {
                Registry::getSession()->setVariable('usr', $sUserOxid);
            }
            Registry::getUtils()->redirect( $redirect );

        } else {
            //add session error ('Account does not exist')
            Registry::getUtils()->redirect( $this->getConfig()->getShopUrl() . 'index.php?cl=login' );
        }
    }


    private function getRedirectUrlFromRelayState($sRelayState) {
        $aRelayState = unserialize($sRelayState);
        return $aRelayState['redirectUrl'];
    }
}