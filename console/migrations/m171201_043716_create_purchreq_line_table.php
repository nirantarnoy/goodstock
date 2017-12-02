<?php

use yii\db\Migration;

/**
 * Handles the creation of table `purchreq_line`.
 */
class m171201_043716_create_purchreq_line_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('purchreq_line', [
            'id' => $this->primaryKey(),
            'purchreq_id' => $this->integer(),
            'product_id' => $this->integer(),
            'noneitem_name'=> $this->string(),
            'qty'=> $this->float(),
            'price'=> $this->float(),
            'line_amount' => $this->float(),
            'note' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('purchreq_line');
    }
}
