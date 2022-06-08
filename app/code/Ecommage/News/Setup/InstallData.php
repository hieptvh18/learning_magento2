<?php
namespace Ecommage\News\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('ecommage_news');
        if($setup->getConnection()->isTableExists($tableName) == true){
            $data = [
                [
                    'title' => 'News n',
                    'author_id' => 1,
                    'content' => 'this is content news bla bla....',
                    'featured_images' => 'https://i1-vnexpress.vnecdn.net/2022/06/06/167931596632950jpeg66821641469-7066-9153-1654520731.jpg?w=680&h=408&q=100&dpr=2&fit=crop&s=S9UWtlC9tk6FRtXWWxOLjA',
                    'status' => 1,
                    'url_key'=>'https://facebook.com',
                        'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s'),

                ],
                [
                    'title' => 'News 2',
                    'author_id' => 2,
                    'content' => 'this is content news bla bla....',
                    'featured_images' => 'https://i1-vnexpress.vnecdn.net/2022/06/06/167931596632950jpeg66821641469-7066-9153-1654520731.jpg?w=680&h=408&q=100&dpr=2&fit=crop&s=S9UWtlC9tk6FRtXWWxOLjA',
                    'status' => 3,
                    'url_key'=>'https://facebook.com',
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s'),

                ]
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $setup->endSetup();
    }
}
