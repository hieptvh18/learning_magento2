<?php

namespace Ecommage\Blog\Plugin;

class SendMailCancelOrder{

    protected $_helper;
    protected $_orderModel;
    protected $url;

    public function __construct(\Ecommage\Blog\Helper\Data $_helper,
                                \Magento\Sales\Model\OrderFactory $orderModel,
                                \Magento\Framework\UrlInterface $url)
    {
        $this->url = $url;
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
            //
        }
    }

}
