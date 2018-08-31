<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site`.
 */
class m180831_122603_create_site_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('site', [
            'id'          => $this->primaryKey(),
            'id_category' => $this->integer(),
            'site_name'   => $this->string(150)->notNull(),
            'description' => $this->text(),
            'url'         => $this->string(150),
            'author'      => $this->string(150),
            'created_at'  => $this->integer()->null(),
            'created_by'  => $this->integer()->null(),
        ]);

        $this->createTable('category', [
            'id'          => $this->primaryKey(),
            'category_name'   => $this->string(150)->notNull(),
            'created_at'  => $this->integer()->null(),
            'created_by'  => $this->integer()->null(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('site');
        $this->dropTable('category');
    }
}
