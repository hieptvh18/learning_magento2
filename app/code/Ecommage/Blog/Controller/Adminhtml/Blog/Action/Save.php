<?php
namespace Ecommage\Blog\Controller\Adminhtml\Blog\Action;

use Magento\Backend\App\Action\Context;

class Save extends \Magento\Backend\App\Action{

    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        die('save blog success');
        $data = $this->getRequest()->getParams();
        print_r($data);die;
    }
}
