<?php
namespace Ecommage\HelloWorld\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';
	protected $_eventPrefix = 'ecommage_helloworld_post_collection';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
        // khoi tao model va ResourceModel
		$this->_init('Ecommage\HelloWorld\Model\Post', 'Ecommage\HelloWorld\Model\ResourceModel\Post');
	}

}