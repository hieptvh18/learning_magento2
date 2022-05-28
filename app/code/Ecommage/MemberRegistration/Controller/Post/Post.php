<?php
namespace Ecommage\MemberRegistration\Controller\Post;
use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use \Magento\Framework\View\Result\PageFactory;

class Post extends Action implements HttpPostActionInterface
{


    public function execute()
    {
        var_dump($this->getRequest()->getParams());die;
    }
}
