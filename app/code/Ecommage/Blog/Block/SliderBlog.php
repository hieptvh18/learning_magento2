<?php

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;


class SliderBlog extends Template
{
    protected $_template = 'Ecommage_Blog::slider.phtml';
    protected $_blogFactory;

    public function __construct(Template\Context $context, array $data = [],
                                \Ecommage\Blog\Model\BlogFactory $blogFactory
)
    {
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

//    get slider

    public function getSliderItems(){
        $data = $this->_blogFactory->create()->getCollection()->addFieldToFilter('status',['eq'=>1]);
        return $data;
    }
}
