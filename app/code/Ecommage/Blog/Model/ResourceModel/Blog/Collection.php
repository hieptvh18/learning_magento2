<?php
namespace Ecommage\Blog\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';
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
		$this->_init('Ecommage\Blog\Model\Blog', 'Ecommage\Blog\Model\ResourceModel\Blog');
	}

}
