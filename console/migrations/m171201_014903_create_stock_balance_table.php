<?php

use yii\db\Migration;

class m171201_014903_create_stock_balance_table extends Migration
{
    public function up()
    {

        $this->createTable('stock_balance', [
            'id' => $this->primaryKey(),
            'party_id' => $this->integer(),
            'product_id' => $this->integer(),
            'warehouse_id' => $this->integer(),
            'location_id' => $this->integer(),
            'lot_id' => $this->integer(),
            'quantity' => $this->float(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    public function down()
    {

        $this->dropTable('stock_balance');
    }

}
