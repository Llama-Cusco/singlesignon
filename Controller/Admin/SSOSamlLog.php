<?php

namespace Itratos\SingleSignOn\Controller\Admin;


class SSOSamlLog extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{

    public function render()
    {
        parent::render();

        $logger = oxNew(\Itratos\SingleSignOn\Core\Logger::class);

        $this->_aViewData['sso_samllog'] = $logger->getLogContent();

        return 'ssosamllog.tpl';
    }


}
