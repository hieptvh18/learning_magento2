<?php


namespace Ecommage\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InstallDataBlog implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup

    ) {

        $this->moduleDataSetup = $moduleDataSetup;

    }
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $setup = $this->moduleDataSetup;

        $data[] = [
            'title' => 'this is title blog',
            'author_id' => 1,
            'url_key'=>'https://faceobook.com',
            'content'=>'bla bla bla bla content',
            'featured_image'=>'https://i1-thethao.vnecdn.net/2022/06/09/manh-dung-jpg-1654739096-16547-9272-7722-1654739368.jpg?w=680&h=408&q=100&dpr=2&fit=crop&s=JZoQb09U8ws53RL2Ul643A',
            'status'=>2,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        $data[] = [
            'title' => 'this is title blog 2',
            'author_id' => 1,
            'url_key'=>'https://faceobook.com',
            'content'=>'bla bla bla bla content new 2',
            'featured_image'=>'https://i1-kinhdoanh.vnecdn.net/2022/06/08/screenshot-2022-06-08-at-6-24-5767-7567-1654688253.png?w=680&h=0&q=100&dpr=2&fit=crop&s=KFSuCqI9ZkXWJxAMeflaIQ',
            'status'=>2,
            'created_at'=>date('Y-m-m H:i:s'),
            'updated_at'=>date('Y-m-m H:i:s')
        ];

        $this->moduleDataSetup->getConnection()->insertArray(
            $this->moduleDataSetup->getTable('ecommage_blog'),
            ['title', 'author_id','url_key','content','featured_image','status','created_at','updated_at'],
            $data
        );
        $this->moduleDataSetup->endSetup();
    }
    public function getAliases()
    {
        return [];
    }
    public static function getDependencies()
    {
        return [];
    }
}
