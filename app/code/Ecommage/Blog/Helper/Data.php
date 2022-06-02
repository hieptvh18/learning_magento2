<?php

namespace Ecommage\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;


class Data extends AbstractHelper
{
    protected $configWriter;
    const XML_PATH_BLOG = 'blog/';

    public function __construct(Context $context, WriterInterface $configWriter)
    {
        $this->configWriter = $configWriter;
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

    //update enable value on score_config_data

    /**
     * @return \Magento\Framework\Cache\ConfigInterface
     */
    public function updateConfigValue($value)
    {
         $this->configWriter->save(self::XML_PATH_BLOG .'general/enable', $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
    }
}
