<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCustomerTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('customers', ['signed' => false])
            ->addColumn('first_name', 'string', ['limit' => 255])
            ->addColumn('last_name', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 255])
            ->create();
    }
}
