<?php

namespace Ecommage\News\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use \Magento\Framework\Message\ManagerInterface;


class Data extends AbstractHelper
{
    const XML_PATH_BLOG = 'news/';
    private $forwardFactory;
    private $manger;

    public function __construct(Context $context, ForwardFactory $forwardFactory, ManagerInterface $manager)
    {
        $this->forwardFactory = $forwardFactory;
        $this->manger = $manager;
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

    public function isEnable($code,$pathForward){
        if (!$this->getGeneralConfig($code)){
             $forward = $this->forwardFactory->create();
            $this->manger->addError(__("Module is not working!"));
            return $forward->forward($pathForward);
        }
    }


}
