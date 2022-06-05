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
        // khoi tao model va ResourceModel
		$this->_init('Ecommage\Blog\Model\Blog', 'Ecommage\Blog\Model\ResourceModel\Blog');
	}

//    join table
    public function joinCustomerTbl(){
        $blogTable = $this->getTable('ecommage_blogs');
        $cusomerTable = $this->getTable('customer_entity');

        $result = $this->addFieldToSelect('firstname','author_name')
            ->join($cusomerTable,$blogTable.'.authur_id='.$cusomerTable.'.entity_id');

        return $result->getSelect();

    }

}
