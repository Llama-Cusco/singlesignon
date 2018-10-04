<?php

use OxidEsales\Eshop\Core\Registry as oxRegistry;


class SSOSamlHelper extends \OxidEsales\Eshop\Core\Utils {

    public static function getSettings() {

        $sEntityId = str_replace(array('http://','https://', 'www.'), '', oxRegistry::getConfig()->getShopUrl());
        $sEntityId = trim($sEntityId, ' /');

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

                'x509cert' => 'MIID9DCCAtygAwIBAgIJAPoL/hGE6pJXMA0GCSqGSIb3DQEBCwUAMIGOMQswCQYD
VQQGEwJERTEQMA4GA1UECAwHQmF2YXJpYTEQMA4GA1UEBwwHQmFtYmVyZzEQMA4G
A1UECgwHSXRyYXRvczEQMA4GA1UECwwHSXRyYXRvczEOMAwGA1UEAwwFU2FzaGEx
JzAlBgkqhkiG9w0BCQEWGHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTAeFw0xODA5
MTExMDQ2NDdaFw0yODA5MTAxMDQ2NDdaMIGOMQswCQYDVQQGEwJERTEQMA4GA1UE
CAwHQmF2YXJpYTEQMA4GA1UEBwwHQmFtYmVyZzEQMA4GA1UECgwHSXRyYXRvczEQ
MA4GA1UECwwHSXRyYXRvczEOMAwGA1UEAwwFU2FzaGExJzAlBgkqhkiG9w0BCQEW
GHNhc2hhMjA1MTQwMjQ1QGdtYWlsLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEP
ADCCAQoCggEBAMn6/nbdHKg4rVC8U0AXjPSO6JbsomJK5ACbwXLBViA7csoqNNuZ
BeHJad9AGQi6ozzy9WJotJe+9PfH1uO5vzmtn4ZmuPCJ1lN0dGXdXJ+B3/8MZVWm
QYdBErm6x2FHPU8bVhBVGty7uxvhIJc66rMfx4kaJ6igCbgrJ8WYoKCqvonswGUd
RRyg0bS+zzXYG+eQj4MCLIsVDz0xauA3pPAM8vSiuR9npUQIz+Rv60WRmianjNSo
rmGXRUZVMWbOEBffDdJ7ouFJJYmpDLMFstHOc7AR551Ez2i4ugjOi5l2CdVqRoF0
F3L6DSmZjZ7VTlCZmhkFRaQfa7lxAWOk8WsCAwEAAaNTMFEwHQYDVR0OBBYEFDQ+
tmbIvUlBJXmn6veFKukp3/S+MB8GA1UdIwQYMBaAFDQ+tmbIvUlBJXmn6veFKukp
3/S+MA8GA1UdEwEB/wQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEBALl4lzxgiaLo
MXDcyQsV6tbZZcW7mCRBcsQuqqsPSxjcSdtGv8/muTzrZtSVprJ9WxEkpConuWvi
3UgGoK4gZXuJ1Uen7uI9+wB7Fv+L/2WvLLIK0jUgfvAuiPfAt4EuHUfxtjrt3+Cx
WQ2F5/Kmhox5SbCm6WKy8M3mrQa7s/yeGPODLZ+Vy1TjoUw7Jm3SUd75N5TaYwpd
ZiuA++j3+mpkYqodldj4u1IM+hFvYhl76kEmDFOzD98FqXjkpFVmmJhRKRHliyyc
UB+yy0dauPNBQKs9re+3t69jVCeKyJc526/fd6+3KyWcsw+T7hopTZXY0E/Xm+im
3n/5mMj7vhQ=\'',
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
                'x509cert' => 'MIIFnDCCBISgAwIBAgITPAAAoiWAhcBOOfmXBAAAAACiJTANBgkqhkiG9w0BAQsF
ADBGMRMwEQYKCZImiZPyLGQBGRYDY29tMRYwFAYKCZImiZPyLGQBGRYGc29jb3Rv
MRcwFQYDVQQDEw5zb2NvdG8gUm9vdCBDQTAeFw0xNjA2MjMxMDM3NDVaFw0xODA2
MjMxMDM3NDVaMIGcMQswCQYDVQQGEwJERTEYMBYGA1UECBMPUmhlaW5sYW5kLVBm
YWx6MQ4wDAYDVQQHEwVUcmllcjEdMBsGA1UEChQUc29jb3RvIGdtYmggJiBjby4g
a2cxCzAJBgNVBAsTAklUMRkwFwYDVQQDExB0ZXN0LXNvY290by1zYW1sMRwwGgYJ
KoZIhvcNAQkBFg1pdEBzb2NvdG8uY29tMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8A
MIIBCgKCAQEA8DpsD3CA9APX+a7+It+PtXQOItGN2tbVaxTlosrwS5EOaFHMiV52
SUCD5m+qsVDD/6fyrDqhWgF/LODl81SU/kNxVLwIt8YPgnvixs8Qf4M3HDRXgZig
XmX+B9quO62tJE5yJD3F7NV+xzbNydtzxdt0qRtO5p+7FgK4upS2AYrBZON6y6Lh
kUkeGlYgosRWfHdoAL/rx5WpjMDy0bIhw77QL5vXZp1v/IALpyeKtgWXAWEZi6wI
tsr+Pb/9aDEc9XNtccnVWOB6srXSQ3K6AZKTHSRaWp0rUWzLQkIZrpVCDIQx4CIm
oA87NaSbYtJkTen132XCEPY0SBTNuUPPCQIDAQABo4ICKjCCAiYwHQYDVR0OBBYE
FA0VAFmkwgI5dDoQbafP2+b2VWGUMB8GA1UdIwQYMBaAFGz381CzCwdcr+z1/m7X
umEWd2qbMIHSBgNVHR8EgcowgccwgcSggcGggb6GgbtsZGFwOi8vL0NOPXNvY290
byUyMFJvb3QlMjBDQSxDTj1zY3QtZGMxLENOPUNEUCxDTj1QdWJsaWMlMjBLZXkl
MjBTZXJ2aWNlcyxDTj1TZXJ2aWNlcyxDTj1Db25maWd1cmF0aW9uLERDPWFnZW5j
aXJjbGUsREM9ZGU/Y2VydGlmaWNhdGVSZXZvY2F0aW9uTGlzdD9iYXNlP29iamVj
dENsYXNzPWNSTERpc3RyaWJ1dGlvblBvaW50MIHGBggrBgEFBQcBAQSBuTCBtjCB
swYIKwYBBQUHMAKGgaZsZGFwOi8vL0NOPXNvY290byUyMFJvb3QlMjBDQSxDTj1B
SUEsQ049UHVibGljJTIwS2V5JTIwU2VydmljZXMsQ049U2VydmljZXMsQ049Q29u
ZmlndXJhdGlvbixEQz1hZ2VuY2lyY2xlLERDPWRlP2NBQ2VydGlmaWNhdGU/YmFz
ZT9vYmplY3RDbGFzcz1jZXJ0aWZpY2F0aW9uQXV0aG9yaXR5MCEGCSsGAQQBgjcU
AgQUHhIAVwBlAGIAUwBlAHIAdgBlAHIwDgYDVR0PAQH/BAQDAgWgMBMGA1UdJQQM
MAoGCCsGAQUFBwMBMA0GCSqGSIb3DQEBCwUAA4IBAQCMPVCWvH5Czt4+xrJWx/cP
ksQpA1h4n70RFQP8Q1KNcpRH717YmnX1nHtleNy7bFpnOeQ1iAcqvrUbJhP8pjS/
ef0hihnb/2YzgJn+YN1995Wm3yvTUg5T1zZx9iMgVdiju4T+7U/kl3sxcNBdBfFR
u7cga3yY5rTnUM9tHMhiAidbRLcxvIDP8Mtun7eLFOFxr0IO3h3vrHWnBGRrE7BH
7HnMu3X1PxGNq6SaAPVPCHTY6D+hDUynUhb+uQ6zBnRFj7ByCgGK/3UzVxIXqeV6
RUbIZOIEUWn5JA4sGyl2ky3DAkVhhnZ2W/k/Rm4Jq/O5ap7mArfoM1TaKVmePhX9'
            )
        );

        $aSettings['hyundai-merchandising.com'] = array (
            'strict' => false,
            'debug' => false,
            'baseurl' => 'https://hyundai-merchandising.com',

            'sp' => array (
                'entityId' => 'hyundai-merchandising.com',
                'assertionConsumerService' => array (
                    'url' => 'https://hyundai-merchandising.com/index.php?cl=ssoacscontroller',
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
                    'url' => 'https://hyundai-merchandising.com/index.php?cl=ssologoutcontroller',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',

                'x509cert' => 'MIID1DCCArygAwIBAgIJAJPbXkXd+upeMA0GCSqGSIb3DQEBCwUAMH8xCzAJBgNV
BAYTAkRFMRMwEQYDVQQIDApTb21lLVN0YXRlMRAwDgYDVQQKDAdJdHJhdG9zMRAw
DgYDVQQLDAdJdHJhdG9zMQ4wDAYDVQQDDAVsbGFtYTEnMCUGCSqGSIb3DQEJARYY
c2FzaGEyMDUxNDAyNDVAZ21haWwuY29tMB4XDTE4MTAwMzEzMjkxMloXDTI4MTAw
MjEzMjkxMlowfzELMAkGA1UEBhMCREUxEzARBgNVBAgMClNvbWUtU3RhdGUxEDAO
BgNVBAoMB0l0cmF0b3MxEDAOBgNVBAsMB0l0cmF0b3MxDjAMBgNVBAMMBWxsYW1h
MScwJQYJKoZIhvcNAQkBFhhzYXNoYTIwNTE0MDI0NUBnbWFpbC5jb20wggEiMA0G
CSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDdW1CoI38oWjMZjpjOcrxVqsyrFBpN
uxfUO1DLlaX0WdNovvSLURaCIBzvgBUhlNHMIf3WpUzEjwIE9nuJ0VZS+yoQXyVa
lwi+6z58kUS6MKZlGv4kNvit9eovXDpDNY+IwtVZdR/vQOIqlp65HxP/bJ1KDlQd
UJWToaay3b8CoDWASDFHk0SH4Nr3+CpWMdj+jofQKRX6IxerFP11hRT0Z0+pi5k3
CGLpjJApNtOSO0WzjpfIXzEO/E0ctiqy7T4P0ApD1Z8YtPm1xIqrH6bQbV1ZGgRw
8i0/NyvumkCiCch2zrs2QxL47PX7CFoWcECEb0vc9QnssA3UdqaGsU6TAgMBAAGj
UzBRMB0GA1UdDgQWBBQXZ6Zbut7OE40MkLLZm0qkuDWEWDAfBgNVHSMEGDAWgBQX
Z6Zbut7OE40MkLLZm0qkuDWEWDAPBgNVHRMBAf8EBTADAQH/MA0GCSqGSIb3DQEB
CwUAA4IBAQBTi8ymNgrxmnxLO24oNGuxDM4/WGA5X5C6U2f9HNsPz2RJLEdWCme9
9OxT/cg7ekPvyZEDck69L82LRop4j2y70py36QBp0i8ZZuYuw2BWDiKysIOC9S3a
XMyBQvfaVNuL29msbiWe8Ds7mdjCyq2Vm8g8ahQJbH18YvNI8uX08Pmyvmz5DMA/
oSUa+fH52b1nZbMKy4txTgrvgjLZzWjTrI3GkNqozcPuvIRO98eGsHtChz9FoErh
ECD7UBoE1ZrGGflYGyKiCdOsFVNtgxXEaBL4I8HEnc/sqpL8XS0vosi0Az1RGW/f
7KD5z0fPvy/mLxDn4CtLlEA5bfJFM3No',
                'privateKey' => '',
                // 'x509certNew' => '',
            ),

            'idp' => array (
                'entityId' => 'https://mms.socoto.com/saml',
                'singleSignOnService' => array (
                    'url' => 'https://mms.socoto.com/saml/consumer',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),

                'singleLogoutService' => array (
                    'url' => 'https://mms.socoto.com/saml/slo',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),

                // Public x509 certificate of the IdP
                'x509cert' => 'MIIFnDCCBISgAwIBAgITPAAAlueTrtVFqSTXuwAAAACW5zANBgkqhkiG9w0BAQsF
ADBGMRMwEQYKCZImiZPyLGQBGRYDY29tMRYwFAYKCZImiZPyLGQBGRYGc29jb3Rv
MRcwFQYDVQQDEw5zb2NvdG8gUm9vdCBDQTAeFw0xNjA1MDMxMDE0MDdaFw0xODA1
MDMxMDE0MDdaMIGcMQswCQYDVQQGEwJERTEYMBYGA1UECBMPUmhlaW5sYW5kLVBm
YWx6MQ4wDAYDVQQHEwVUcmllcjEdMBsGA1UEChQUc29jb3RvIGdtYmggJiBjby4g
a2cxCzAJBgNVBAsTAklUMRkwFwYDVQQDExBwcm9kLXNvY290by1zYW1sMRwwGgYJ
KoZIhvcNAQkBFg1pdEBzb2NvdG8uY29tMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8A
MIIBCgKCAQEAy8EqgSZlhfwWXSZ0zOPQuh7V1pmTpbBv6HQByWW4RpS3qEOkkCuP
srpc+U6Cyx+A/xDMP8MUdaStjp43ZDxZtP5NfiXJ6o6nBqwuQ5suopb8zVFYh4Nd
kZ7R1p9zCrPFlWjy7yHtJrJx0NvfAQDyrxIqXyVfTHYH95cncB831KVlKzPAHrrM
wdLfCZEqOcLCa9XexV3Lud2hjIPfulsjNYWD+095LnG1YI/0S0UGi6fszEBPAwKd
n/CZIIdBVMaTFA0iA9wLucxAXhPVN5EvNvzKq9nwR8g56b/QuVBM687BdWT43v+1
DcqhQJDvK1FPw0ssRDhjl2RyxIihPav4jwIDAQABo4ICKjCCAiYwHQYDVR0OBBYE
FGUWPu9ZFIFeMoARwzd19Yb0vsfEMB8GA1UdIwQYMBaAFGz381CzCwdcr+z1/m7X
umEWd2qbMIHSBgNVHR8EgcowgccwgcSggcGggb6GgbtsZGFwOi8vL0NOPXNvY290
byUyMFJvb3QlMjBDQSxDTj1zY3QtZGMxLENOPUNEUCxDTj1QdWJsaWMlMjBLZXkl
MjBTZXJ2aWNlcyxDTj1TZXJ2aWNlcyxDTj1Db25maWd1cmF0aW9uLERDPWFnZW5j
aXJjbGUsREM9ZGU/Y2VydGlmaWNhdGVSZXZvY2F0aW9uTGlzdD9iYXNlP29iamVj
dENsYXNzPWNSTERpc3RyaWJ1dGlvblBvaW50MIHGBggrBgEFBQcBAQSBuTCBtjCB
swYIKwYBBQUHMAKGgaZsZGFwOi8vL0NOPXNvY290byUyMFJvb3QlMjBDQSxDTj1B
SUEsQ049UHVibGljJTIwS2V5JTIwU2VydmljZXMsQ049U2VydmljZXMsQ049Q29u
ZmlndXJhdGlvbixEQz1hZ2VuY2lyY2xlLERDPWRlP2NBQ2VydGlmaWNhdGU/YmFz
ZT9vYmplY3RDbGFzcz1jZXJ0aWZpY2F0aW9uQXV0aG9yaXR5MCEGCSsGAQQBgjcU
AgQUHhIAVwBlAGIAUwBlAHIAdgBlAHIwDgYDVR0PAQH/BAQDAgWgMBMGA1UdJQQM
MAoGCCsGAQUFBwMBMA0GCSqGSIb3DQEBCwUAA4IBAQBZmY3owX2PvyMJOVqaf9th
dA/8O7tQSZsd0MMKv8Ah22K6TVfw/CV0soq9naYr7KvgUEr8gCl8+LkDAlnJRyl2
iLT9FEeqBvW0a3xXCWsy229gs3EmdudIH38toUd8f3nrGyOkHs84Qa7UDi1XA2h8
T25sZ861PJCdtLK7A9TBrr68ev49q4a/Qo1gEdJMCMarkCHGQymzK710/ZPyqNLw
grDkcORBE+7TB+OC1+2sq3gLFNVvmt8Gz7buul12U+KABqtJyZR61zAJ+6hGh8Vh
Hj9p5GXMPTEEkauCnGqLl3CQDId+aeRAfVG+jIulxcBUhpPu48TfrQIFLlI+Uolq'
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