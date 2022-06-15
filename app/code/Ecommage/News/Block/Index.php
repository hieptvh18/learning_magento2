<?php
declare(strict_types=1);

namespace Ecommage\News\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;
use \Ecommage\News\Model\ResourceModel\News\Collection;


class Index extends Template
{
    protected $_newsFactory;
    protected $_collection;
    protected $_helper;
    protected $_template = 'Ecommage_News::index.phtml';

    public function __construct(Template\Context $context, array $data = [],
                                \Ecommage\News\Model\NewsFactory $newsFactory ,
                                \Ecommage\News\Helper\Data $helper,
                                Collection $collection)
    {
        $this->_helper = $helper;
        $this->_collection = $collection;
        $this->_newsFactory = $newsFactory;
        parent::__construct($context, $data);
    }

//    protected function _prepareLayout()
//    {
//        parent::_prepareLayout();
//        $this->setTemplate('Ecommage_News::index.phtml');
//        return $this;
//    }

    /*
     * get list news != 2&3 -> render to menu fe
     * */
    public function getNewsCollection(){
        $news = $this->_newsFactory->create()->getCollection()
//            ->addFieldToFilter('status',['neq'=>3])
//            ->addFieldToFilter('status',['neq'=>2])
//        or
                ->addFilter('status',1)
        ;
        return $news;
    }

    /*
     * get post by id
     * */
    public function getNewsRand(){
        $news = $this->_newsFactory->create()->getCollection()
            ->setOrder('created_at','desc')
            ->addFilter('status',1)->getLastItem();
        return $news;
    }

    public function getDataJoinUserTbl(){
        return $this->_collection->joinAdminUserTbl();
    }

}
