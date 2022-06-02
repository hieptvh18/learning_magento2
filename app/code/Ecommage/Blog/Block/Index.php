<?php
declare(strict_types=1);

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;


class Index extends Template
{
    protected $_blogFactory;

    public function __construct(Template\Context $context, array $data = [],
                                \Ecommage\Blog\Model\BlogFactory $blogFactory )
    {
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    /*
     * get list blog-> render to menu fe
     * */
    public function getBlogCollection(){
        $blogs = $this->_blogFactory->create()->getCollection();
        return $blogs;
    }

    /*
     * get post by id
     * */
    public function getBlog($id = 1){
        $blogs = $this->_blogFactory->create()->load($id)->getData();
        return $blogs;
    }

}
