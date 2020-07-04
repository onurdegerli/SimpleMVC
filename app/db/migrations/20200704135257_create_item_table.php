<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateItemTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('items', ['signed' => false])
            ->addColumn('ean', 'string', ['limit' => 16])
            ->addColumn('price', 'float')
            ->create();
    }
}
