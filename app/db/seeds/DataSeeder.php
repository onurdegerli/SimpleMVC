<?php

use Phinx\Seed\AbstractSeed;

class DataSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $this->set_tables();
        $this->truncateTables();

        $faker = Faker\Factory::create();
    }

    /**
     * Sets table instances.
     * @return void
     */
    private function set_tables(): void
    {
    }

    /**
     * Truncates table before storing data.
     * @return void
     */
    private function truncateTables(): void
    {
        $this->execute('SET foreign_key_checks=0');
    }
}
