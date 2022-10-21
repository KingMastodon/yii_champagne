<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%goals_apis}}`.
 */
class m221020_203421_create_goals_apis_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%goals_apis}}', [
            'id' => $this->primaryKey(),

            'base_url' => $this->text()->notNull(),

            'id_param_name' => $this->string(255)->notNull(),

            'goal_param_name' => $this->string(255)->notNull(),

            'price_param_name' => $this->string(255)->notNull(),

            'request_type' => $this->string(20)->notNull(),
        ]);
        $this->insert('{{%goals_apis}}', [
            'base_url' => 'https://example.com/postback',
            'id_param_name' => 'id',
            'goal_param_name' => 'goal',
            'price_param_name' => 'amount',
            'request_type' => 'GET',
        ]);
        $this->insert('{{%goals_apis}}', [
            'base_url' => 'https://google.com/',
            'id_param_name' => 'cid',
            'goal_param_name' => 'event',
            'price_param_name' => 'price',
            'request_type' => 'POST',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%goals_apis}}');
    }
}
