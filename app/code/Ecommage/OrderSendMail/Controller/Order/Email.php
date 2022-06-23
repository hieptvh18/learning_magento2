<?php
namespace Ecommage\OrderSendMail\Controller\Order;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Email extends Action implements HttpPostActionInterface {

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $email = $this->getRequest()->getParam('email');
        $order = $this->_objectManager->create('Magento\Sales\Model\Order')->load(1); // this is entity id
        $order->setCustomerEmail($email);
        if ($order) {
            try {
                $this->_objectManager->create('\Magento\Sales\Model\OrderNotifier')
                    ->notify($order);
                $this->messageManager->addSuccess(__('You sent the order email.'));
                die('You sent the order email.');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                die('er');
            } catch (\Exception $e) {
                $this->messageManager->addError(__('We can\'t send the email order right now.'));
                $this->_objectManager->create('Magento\Sales\Model\OrderNotifier')->critical($e);
            }
        }
    }
}
