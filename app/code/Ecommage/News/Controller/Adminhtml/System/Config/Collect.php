<?php

namespace Ecommage\News\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Ecommage\News\Helper\Data;

class Collect extends Action
{

    protected $resultJsonFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        Data $helper
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * Collect relations data
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        try {
            $this->_getSyncSingleton()->collectRelations();
        } catch (\Exception $e) {
            $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
        }

        $lastCollectTime = $this->helper->getLastCollectTime();
        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultJsonFactory->create();

        return $result->setData(['success' => true, 'time' => $lastCollectTime]);
    }

    /**
     * Return product relation singleton
     *
     * @return \Mageplaza\HelloWorld\Model\Relation
     */
    protected function _getSyncSingleton()
    {
        return $this->_objectManager->get('Ecommage\News\Model\Relation');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ecommage_News::news');
    }
}
?>
