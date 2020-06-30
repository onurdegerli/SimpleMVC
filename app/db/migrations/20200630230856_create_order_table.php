<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOrderTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('orders', ['signed' => false])
            ->addColumn('purchase_at', 'datetime')
            ->addColumn('country_id', 'integer', ['signed' => false])
            ->addColumn('device_id', 'integer', ['signed' => false])
            ->addForeignKey('country_id', 'countries', 'id')
            ->addForeignKey('device_id', 'devices', 'id')
            ->addIndex(['id','country_id'], ['name' => 'idx_id_country'])
            ->addIndex(['id','device_id'], ['name' => 'idx_id_device'])
            ->addIndex(['id','country_id','device_id'], ['name' => 'idx_id_country_device'])
            ->create();
    }
}
