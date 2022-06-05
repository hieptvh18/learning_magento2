<?php

namespace Ecommage\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;


class Data extends AbstractHelper
{
    const XML_PATH_BLOG = 'blog/';

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /*
    * khai bao method get value config enable module
    */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /*
     * action get value
     * */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_BLOG .'general/'. $code, $storeId);
    }

    public function hi(){
        return 'hi';
    }


}
