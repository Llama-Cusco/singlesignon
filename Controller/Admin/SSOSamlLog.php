<?php

namespace Itratos\SingleSignOn\Controller\Admin;


class SSOSamlLog extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{
    protected $_sThisTemplate = 'ssosamllog.tpl';

    public function render()
    {
        parent::render();

        $logger = oxNew(\Itratos\SingleSignOn\Core\Logger::class);

        $this->_aViewData['sso_samllog'] = $logger->getLogContent();

        return parent::render();
    }


}
