<?php
namespace Ecommage\HelloWorld\Model\ResourceModel;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use \Magento\Framework\Model\ResourceModel\Db\Context;

class Post extends AbstractDb
{
	
	public function __construct(
		Context $context
	)
	{
		parent::__construct($context);
	}
	
    // method bat buoc cua AbstractDb
	protected function _construct()
	{
        // xac dinh ten bang va khoa chinh cho bang
		$this->_init('ecommage_helloworld_post', 'post_id');
	}
	
}