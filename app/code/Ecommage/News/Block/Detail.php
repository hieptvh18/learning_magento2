<?php
declare(strict_types=1);

namespace Ecommage\News\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;
use Ecommage\News\Model\NewsFactory;
use Magento\Framework\App\Action\Forward;

class Detail extends Template{

    private $forward;
    protected $_newsFactory;

    public function __construct(Template\Context $context, array $data = [],
    NewsFactory $newsFactory,
    Forward $forward)
    {
        $this->forward = $forward;
        $this->_newsFactory = $newsFactory;
        parent::__construct($context, $data);
    }

    public function getAuthor($id){
    }
}
