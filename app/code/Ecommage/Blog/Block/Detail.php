<?php
declare(strict_types=1);

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;
use Ecommage\Blog\Model\BlogFactory;
use Magento\Framework\App\Action\Forward;

class Detail extends Template{

    private $forward;
    protected $_blogFactory;

    public function __construct(Template\Context $context, array $data = [],
    BlogFactory $blogFactory,
    Forward $forward)
    {
        $this->forward = $forward;
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    public function getAuthor($id){
    }
}
