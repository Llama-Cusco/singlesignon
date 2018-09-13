<?php

use OxidEsales\Eshop\Core\Registry as oxRegistry;


class SSOSamlHelper extends \OxidEsales\Eshop\Core\Utils {

    public static function getSettings() {

        $sEntityId = str_replace(array('http://','https://'), '', oxRegistry::getConfig()->getShopUrl());
        $sEntityId = trim($sEntityId, ' /');

        var_dump($sEntityId);

        $aSettings['dev.hyundai-merchandising.com'] = array (
            'strict' => false,
            'debug' => false,
            'baseurl' => 'http://dev.hyundai-merchandising.com',

            'sp' => array (
                'entityId' => 'dev.hyundai-merchandising.com',
                'assertionConsumerService' => array (
                    'url' => 'https://dev.hyundai-merchandising.com/index.php?cl=ssoacscontroller',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),
                "attributeConsumingService"=> array(
                    "ServiceName" => "SP test",
                    "serviceDescription" => "Test Service",
                    "requestedAttributes" => array(
                        array(
                            "name" => "",
                            "isRequired" => false,
                            "nameFormat" => "",
                            "friendlyName" => "",
                            "attributeValue" => ""
                        )
                    )
                ),

                'singleLogoutService' => array (
                    'url' => 'https://dev.hyundai-merchandising.com/index.php?cl=ssologoutcontroller',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',

                'x509cert' => '',
                'privateKey' => '',
                // 'x509certNew' => '',
            ),

            'idp' => array (
                'entityId' => 'https://mms-te.socoto.com/saml',
                'singleSignOnService' => array (
                    'url' => 'https://mms-te.socoto.com/saml/consumer',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),

                'singleLogoutService' => array (
                    'url' => 'https://mms-te.socoto.com/saml/slo',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),

                // Public x509 certificate of the IdP
                'x509cert' => ''
            )
        );

        $aSettings['oxid6'] = array (
            'strict' => false,
            'debug' => false,
            'baseurl' => 'http://oxid6/llama',

            'sp' => array (
                'entityId' => 'oxid6',
                'assertionConsumerService' => array (
                    'url' => 'http://oxid6/index.php?cl=ssoacscontroller',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),
                "attributeConsumingService"=> array(
                    "ServiceName" => "SP test",
                    "serviceDescription" => "Test Service",
                    "requestedAttributes" => array(
                        array(
                            "name" => "",
                            "isRequired" => false,
                            "nameFormat" => "",
                            "friendlyName" => "",
                            "attributeValue" => ""
                        )
                    )
                ),

                'singleLogoutService' => array (
                    'url' => 'http://oxid6/index.php?cl=ssologoutcontroller',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',
                'x509cert' => '',
                'privateKey' => '',
                // 'x509certNew' => '',
            ),

            'idp' => array (
                'entityId' => 'oxid6-1',
                'singleSignOnService' => array (
                    'url' => 'http://oxid6-1/simplesaml/saml2/idp/SSOService.php',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),

                'singleLogoutService' => array (
                    'url' => 'http://oxid6-1/simplesaml/saml2/idp/SingleLogoutService.php',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),

                // Public x509 certificate of the IdP
                'x509cert' => 'MIID7jCCAtagAwIBAgIJAKe8Gg/Tlme2MA0GCSqGSIb3DQEBCwUAMIGLMQswCQYDVQQGEwJERTEPMA0GA1UECAwGQmVybGluMQ8wDQYDVQQHDAZCZXJsaW4xITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDEOMAwGA1UEAwwFbGxhbWExJzAlBgkqhkiG9w0BCQEWGHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTAeFw0xODA5MDQxNDMwMjVaFw0yODA5MDMxNDMwMjVaMIGLMQswCQYDVQQGEwJERTEPMA0GA1UECAwGQmVybGluMQ8wDQYDVQQHDAZCZXJsaW4xITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDEOMAwGA1UEAwwFbGxhbWExJzAlBgkqhkiG9w0BCQEWGHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBANlNeEayrzZd2dQXl/87nn2GR3ozxwbqhlIcUU27dKoayoVWKTxmVGOgo3t3viJ6evfMYqlRVb+3gx0tHDWpUjQ14GgzT983crlraTmauOjZFsC4pFOsGSmjqVKgP2+XyHn3PMpTRtZHU8gz7kcq+R0SNRnd1QEk0NCIkXkf51JV6COkIsVhFi7139/yD9vJrWiR7TR1CwyCo51sTO9q1chsUqHQnTjhRuyWOIkYAsNk7HdfMCpIuCUVrbGa9qrv6OM/X9CYrwoYg6BMCRZfQHwAs5oFcUL6aP0EiqgMEtWeqRCSUpZVVas8p6UvBpHHLCI1n8sxvuVylcFUU88qD3MCAwEAAaNTMFEwHQYDVR0OBBYEFPY2F6cHsf0agpzTQNoCxfmgozGbMB8GA1UdIwQYMBaAFPY2F6cHsf0agpzTQNoCxfmgozGbMA8GA1UdEwEB/wQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEBABnKBW+wF8ZsJ6ew4i7NsA0ooi38JB0ggkup9zRTPd8U3vLh7DHg7C73QH/tXeeVhwWt5frln9dqtaFxoZm2EhjN+NNL+pDknKHjwJHQIJKYUxribIW79TfulrElYEfRMVOgPXiD2yaBnQ71yC95bg+jcEUjCwtfJ7kfDg6b33x0pkh986o4PNw9nxWPau+TNYSSyAfBYvF4ppkJmAjvVOvxOrvcYpeCnFGOXw8AL+stXnUAVs8GVOVnZJaS+ByDbmk4LBo0t9JhEzlTBDQTI3g+7rGO9EVxaDOZn7h6sSdwEQG4zXmSGI6hS7ffUAoRgcVbwSulkZH8w3Z36kyf56k=',

            )
        );

        $aSettings['ollama'] = array (
            'strict' => false,
            'debug' => false,
            'baseurl' => 'http://ollama/llama',
            'sp' => array (

                'entityId' => 'ollama',

                'assertionConsumerService' => array (
                    'url' => 'http://ollama/index.php?cl=ssoacscontroller',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),

                "attributeConsumingService"=> array(
                    "ServiceName" => "SP test",
                    "serviceDescription" => "Test Service",
                    "requestedAttributes" => array(
                        array(
                            "name" => "",
                            "isRequired" => false,
                            "nameFormat" => "",
                            "friendlyName" => "",
                            "attributeValue" => ""
                        )
                    )
                ),

                'singleLogoutService' => array (
                    'url' => 'http://ollama/index.php?cl=ssologoutcontroller',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),

                'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',

                'x509cert' => '',
                'privateKey' => '',
                // 'x509certNew' => '',
            ),


            'idp' => array (
                'entityId' => 'oxid6-1',
                'singleSignOnService' => array (
                    'url' => 'http://oxid6-1/simplesaml/saml2/idp/SSOService.php',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),

                'singleLogoutService' => array (
                    'url' => 'http://oxid6-1/simplesaml/saml2/idp/SingleLogoutService.php',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),

                // Public x509 certificate of the IdP
                'x509cert' => 'MIID7jCCAtagAwIBAgIJAKe8Gg/Tlme2MA0GCSqGSIb3DQEBCwUAMIGLMQswCQYDVQQGEwJERTEPMA0GA1UECAwGQmVybGluMQ8wDQYDVQQHDAZCZXJsaW4xITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDEOMAwGA1UEAwwFbGxhbWExJzAlBgkqhkiG9w0BCQEWGHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTAeFw0xODA5MDQxNDMwMjVaFw0yODA5MDMxNDMwMjVaMIGLMQswCQYDVQQGEwJERTEPMA0GA1UECAwGQmVybGluMQ8wDQYDVQQHDAZCZXJsaW4xITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDEOMAwGA1UEAwwFbGxhbWExJzAlBgkqhkiG9w0BCQEWGHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBANlNeEayrzZd2dQXl/87nn2GR3ozxwbqhlIcUU27dKoayoVWKTxmVGOgo3t3viJ6evfMYqlRVb+3gx0tHDWpUjQ14GgzT983crlraTmauOjZFsC4pFOsGSmjqVKgP2+XyHn3PMpTRtZHU8gz7kcq+R0SNRnd1QEk0NCIkXkf51JV6COkIsVhFi7139/yD9vJrWiR7TR1CwyCo51sTO9q1chsUqHQnTjhRuyWOIkYAsNk7HdfMCpIuCUVrbGa9qrv6OM/X9CYrwoYg6BMCRZfQHwAs5oFcUL6aP0EiqgMEtWeqRCSUpZVVas8p6UvBpHHLCI1n8sxvuVylcFUU88qD3MCAwEAAaNTMFEwHQYDVR0OBBYEFPY2F6cHsf0agpzTQNoCxfmgozGbMB8GA1UdIwQYMBaAFPY2F6cHsf0agpzTQNoCxfmgozGbMA8GA1UdEwEB/wQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEBABnKBW+wF8ZsJ6ew4i7NsA0ooi38JB0ggkup9zRTPd8U3vLh7DHg7C73QH/tXeeVhwWt5frln9dqtaFxoZm2EhjN+NNL+pDknKHjwJHQIJKYUxribIW79TfulrElYEfRMVOgPXiD2yaBnQ71yC95bg+jcEUjCwtfJ7kfDg6b33x0pkh986o4PNw9nxWPau+TNYSSyAfBYvF4ppkJmAjvVOvxOrvcYpeCnFGOXw8AL+stXnUAVs8GVOVnZJaS+ByDbmk4LBo0t9JhEzlTBDQTI3g+7rGO9EVxaDOZn7h6sSdwEQG4zXmSGI6hS7ffUAoRgcVbwSulkZH8w3Z36kyf56k=',

            )
        );

        return $aSettings[$sEntityId];
    }
}