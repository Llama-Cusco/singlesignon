<?php

namespace Itratos\SingleSignOn\Controller\Admin;


class SSOSamlLog extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{

    public function render()
    {
        parent::render();

        return 'ssosamllog.tpl';
    }


}
