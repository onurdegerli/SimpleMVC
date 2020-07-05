<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOrderTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('orders', ['signed' => false])
            ->addColumn('customer_id', 'integer', ['signed' => false])
            ->addColumn('country_id', 'integer', ['signed' => false])
            ->addColumn('device_id', 'integer', ['signed' => false])
            ->addColumn('purchase_at', 'datetime')
            ->addForeignKey('customer_id', 'customers', 'id')
            ->addForeignKey('country_id', 'countries', 'id')
            ->addForeignKey('device_id', 'devices', 'id')
            ->addIndex(['id','customer_id'], ['name' => 'idx_id_customer'])
            ->addIndex(['id','country_id'], ['name' => 'idx_id_country'])
            ->addIndex(['id','device_id'], ['name' => 'idx_id_device'])
            ->addIndex(['id','country_id','device_id'], ['name' => 'idx_id_country_device'])
            ->addIndex(['id','country_id','customer_id'], ['name' => 'idx_id_country_customer'])
            ->create();
    }
}
