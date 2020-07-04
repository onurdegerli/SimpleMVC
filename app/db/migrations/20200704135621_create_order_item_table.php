<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOrderItemTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('order_items', ['signed' => false])
            ->addColumn('order_id', 'integer', ['signed' => false])
            ->addColumn('item_id', 'integer', ['signed' => false])
            ->addColumn('quantity', 'integer', ['signed' => false])
            ->addForeignKey('order_id', 'orders', 'id')
            ->addForeignKey('item_id', 'items', 'id')
            ->addIndex('order_id', ['name' => 'idx_order'])
            ->addIndex('item_id', ['name' => 'idx_item'])
            ->addIndex(['order_id','item_id'], ['name' => 'idx_order_items'])
            ->create();
    }
}
