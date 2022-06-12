<?php
namespace Ecommage\News\Model\ResourceModel\News;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'ecommage_news_collection';
	protected $_eventObject = 'news_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
        // init model & ResourceModel
		$this->_init('Ecommage\News\Model\News', 'Ecommage\News\Model\ResourceModel\News');
	}

    //    join table
    public function joinAdminUserTbl()
    {
       $newsTbl  = $this->getTable('ecommage_news');
       $adminUserTbl = $this->getTable('admin_user');

        $collection = $this->join([
            'user'=>$adminUserTbl
        ], 'main_table.id = user.user_id',
            ['author_id'=>'user.firstname']
        );

        return $collection;
    }
}
