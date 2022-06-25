<?php
namespace Ecommage\Blog\Model\ResourceModel\Register;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'ecommage_register_collection';
	protected $_eventObject = 'register_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
        // init model & ResourceModel
		$this->_init('Ecommage\Blog\Model\Register', 'Ecommage\Blog\Model\ResourceModel\Register');
	}

}
