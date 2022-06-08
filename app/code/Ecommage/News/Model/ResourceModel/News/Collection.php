<?php
namespace Ecommage\News\Model\ResourceModel\News;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'ecommage_blog_collection';
	protected $_eventObject = 'blog_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
        // khoi tao model va ResourceModel
		$this->_init('Ecommage\News\Model\News', 'Ecommage\News\Model\ResourceModel\News');
	}

//    join table
    public function joinCustomerTbl(){


    }

}
