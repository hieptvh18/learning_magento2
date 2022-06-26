<?php

namespace Ecommage\Blog\Plugin;

class SendMailCancelOrder{

    protected $_helper;
    protected $_orderModel;
    protected $redirect;
    protected $_messageManager;

    public function __construct(\Ecommage\Blog\Helper\Data $_helper,
                                \Magento\Sales\Model\OrderFactory $orderModel,
                                \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
                                \Magento\Framework\Message\ManagerInterface $messageManager)
    {
        $this->_messageManager = $messageManager;
        $this->redirect= $resultRedirectFactory;
        $this->_helper = $_helper;
        $this->_orderModel = $orderModel;
    }

    /*
     * exc send mail to customer when cancel order*/
    public function afterExecute(\Magento\Sales\Controller\Adminhtml\Order\Cancel $subject)
    {
        $orderId = $subject->getRequest()->getParam('order_id');

        $customerEmail = $this->_orderModel->create()->load($orderId)->getData('customer_email');

        try{
            $this->_helper->sendEmail($customerEmail,'order_cancel','Admin sale');
        }catch (\Exception $e){
            $this->_messageManager->addError(__('You have not canceled the item.'));
        }

        $urlRedirect = $subject->getUrl('sales/order/view/order_id/'.$orderId);
        return $this->redirect->create()->setPath($urlRedirect);
    }

}
