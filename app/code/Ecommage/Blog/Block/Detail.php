<?php
declare(strict_types=1);

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;


class Detail extends Template{

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getAuthor($id){

    }
}
