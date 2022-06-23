<?php
namespace Ecommage\Blog\Model\ResourceModel\Blog;

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
        // init model & ResourceModel
		$this->_init('Ecommage\Blog\Model\Blog', 'Ecommage\Blog\Model\ResourceModel\Blog');
	}

    //    join table
    public function joinAdminUserTbl()
    {
        $blogTbl  = $this->getTable('ecommage_blog');
        $customerTbl = $this->getTable('customer_entity');

        $collection = $this->join([
            'user'=>$customerTbl
        ], 'main_table.author_id = user.entity_id',
            ['firstname'=>'user.firstname','lastname'=>'user.lastname']
        );

        return $collection;
    }
}
