<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%goals_log}}`.
 */
class m221020_002117_create_goals_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%goals_log}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(11),
            'goal' => $this->text()->notNull(),
            'price' => $this->integer(11)->notNull(),
            'data_provider' => $this->integer(5),
            'status' => $this->integer(2)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%goals_log}}');
    }
}
