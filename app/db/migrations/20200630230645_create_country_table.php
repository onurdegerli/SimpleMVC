<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCountryTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('countries', ['signed' => false])
            ->addColumn('name', 'string', ['limit' => 255])
            ->create();
    }
}
