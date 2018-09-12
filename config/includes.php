<?php

if(ENVIRONMENT == 'local') {
    define("TOOLKIT_PATH", '/home/llama/projects/oxid6/vendor/onelogin/php-saml/');
}
else {
    define("TOOLKIT_PATH", '/home/admin/web/dev.hyundai-merchandising.com/vendor/onelogin/php-saml/');
}

require_once(TOOLKIT_PATH . '_toolkit_loader.php');   // We load the SAML2 lib
require_once __DIR__ . '/../Helper/SSOSamlHelper.php';