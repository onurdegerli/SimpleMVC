<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateDeviceTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('devices', ['signed' => false])
            ->addColumn('name', 'string', ['limit' => 255])
            ->create();
    }
}
