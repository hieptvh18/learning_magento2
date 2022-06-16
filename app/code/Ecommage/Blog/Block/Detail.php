<?php

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;

class Detail extends Template
{
    protected  $_template = 'Ecommage_Blog::detail.phtml';

    public function __construct(Template\Context $context, array $data = [],
                                \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }


}
