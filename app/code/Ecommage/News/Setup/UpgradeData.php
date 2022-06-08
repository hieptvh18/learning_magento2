<?php

namespace Ecommage\News\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $_newsFactory;

    public function __construct(\Ecommage\News\Model\NewsFactory $newsFactory)
    {
        $this->_newsFactory = $newsFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.2.0', '<')) {
            $data = [
                'title' => 'News n',
                'author_id' => 1,
                'content' => 'this is content blog bla bla....',
                'featured_images' => 'https://i1-vnexpress.vnecdn.net/2022/06/06/167931596632950jpeg66821641469-7066-9153-1654520731.jpg?w=680&h=408&q=100&dpr=2&fit=crop&s=S9UWtlC9tk6FRtXWWxOLjA',
                'status' => 1,
                'url_key'=>'https://facebook.com',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),

            ];
            $news = $this->_newsFactory->create();
            $news->addData($data)->save();
        }
    }
}
