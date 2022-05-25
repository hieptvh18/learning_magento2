<?php

// setup dung de create table in database
namespace Ecommage\MemberRegistration\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // connect db
        $connection = $setup->getConnection();

        $tableExit = $connection->getTableName('member_registration');

        if(!$connection->isTableExists($tableExit)){
            
                    $table = $connection->newTable($tableExit)->addColumn(
                        'id',Table::TYPE_INTEGER,null,['primary'=>true,'nullable'=>false,'identity'=>true])
                        ->addColumn(
                            'name',Table::TYPE_TEXT,255,['nullable'=>false])
                        ->addColumn(
                                'email',Table::TYPE_TEXT,255,['nullable'=>false])
                        ->setOption('charset','utf8');
            
                    // tao table
                    $connection->createTable($table);
        }

        $setup->endSetup();

    }
}
