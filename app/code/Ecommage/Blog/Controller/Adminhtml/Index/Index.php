<?php

namespace Ecommage\Blog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action{

    public function __construct(Context $context
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        die('ok controller');
    }



}
