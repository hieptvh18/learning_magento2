<?php

namespace Ecommage\Blog\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{
    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Ecommage\Blog\Helper\Data $helperData
    )
    {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    /*
     * use class Vendor/Magento/Framwork/Status -> set disable || enable module
     * */
    public function execute()
    {
        if ($this->helperData->getGeneralConfig('enable') == 0) {
            //  disable ->enable
            $this->helperData->updateConfigValue(1);

            $statusModule = $this->_objectManager->create('Magento\Framework\Module\Status');
            $statusModule->setIsEnabled(true,['Ecommage_Blog']);

            die('update status enable ok');
        }
            // enable -> disable
        $this->helperData->updateConfigValue(0);

        $statusModule = $this->_objectManager->create('Magento\Framework\Module\Status');
        $statusModule->setIsEnabled(false,['Ecommage_Blog']);

        die('update status disable ok');

    }
}
