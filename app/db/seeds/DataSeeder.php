<?php

use Phinx\Db\Table;
use Phinx\Seed\AbstractSeed;

class DataSeeder extends AbstractSeed
{
    private const BASE_DATA_LIMIT = 10;

    private Table $orders;
    private Table $countries;
    private Table $customers;
    private Table $devices;
    private Table $items;
    private Table $orderItems;

    public function run()
    {
        $this->setTables();
        $this->truncateTables();

        $faker = Faker\Factory::create();
        $this->createCountries($faker);
        $this->createDevices($faker);
        $this->createCustomers($faker);
        $this->createItems($faker);
        $this->createOrders($faker);
    }

    private function setTables()
    {
        $this->orders = $this->table('orders');
        $this->countries = $this->table('countries');
        $this->customers = $this->table('customers');
        $this->devices = $this->table('devices');
        $this->items = $this->table('items');
        $this->orderItems = $this->table('order_items');
    }

    /**
     * Truncates table before storing data.
     * @return void
     */
    private function truncateTables(): void
    {
        $this->execute('SET foreign_key_checks=0');
        $this->orders->truncate();
        $this->countries->truncate();
        $this->customers->truncate();
        $this->devices->truncate();
        $this->items->truncate();
        $this->orderItems->truncate();
    }

    private function createCountries(\Faker\Generator $faker)
    {
        for ($i = 1; $i <= self::BASE_DATA_LIMIT; $i++) {
            $this->countries
                ->insert(['name' => $faker->country])
                ->save();
        }
    }

    private function createDevices(\Faker\Generator $faker)
    {
        for ($i = 1; $i <= self::BASE_DATA_LIMIT; $i++) {
            $this->devices
                ->insert(['name' => $faker->userAgent])
                ->save();
        }
    }

    private function createCustomers(\Faker\Generator $faker)
    {
        for ($i = 1; $i <= self::BASE_DATA_LIMIT; $i++) {
            $this->customers
                ->insert(
                    [
                        'first_name' => $faker->firstName,
                        'last_name' => $faker->lastName,
                        'email' => $faker->email,
                    ]
                )
                ->save();
        }
    }

    private function createItems(\Faker\Generator $faker)
    {
        for ($i = 1; $i <= self::BASE_DATA_LIMIT; $i++) {
            $this->items
                ->insert(
                    [
                        'ean' => $faker->numerify('#############'),
                        'price' => $faker->randomFloat(2, 0.1, 50),
                    ]
                )
                ->save();
        }
    }

    private function createOrders(\Faker\Generator $faker)
    {
        $today = date('Y-m-d');
        for ($day = 365; $day > 0; $day--) {
            $purchaseAt = date('Y-m-d', strtotime($today . " - $day days"));
            $orderCountPerDay = rand(0, 30);

            // create orders
            for ($i = 1; $i <= $orderCountPerDay; $i++) {
                $customerId = rand(1, self::BASE_DATA_LIMIT);
                $countryId = rand(1, self::BASE_DATA_LIMIT);
                $deviceId = rand(1, self::BASE_DATA_LIMIT);

                $this->orders
                    ->insert(
                        [
                            'customer_id' => $customerId,
                            'country_id' => $countryId,
                            'device_id' => $deviceId,
                            'purchase_at' => $purchaseAt,
                        ]
                    )
                    ->save();

                $lastOrderId = $this->getAdapter()->getConnection()->lastInsertId();

                // create order items
                $size = rand(1, self::BASE_DATA_LIMIT / 2);
                $itemIds = $this->getUniqueRandomNumbersWithinRange(1, self::BASE_DATA_LIMIT, $size);
                foreach ($itemIds as $itemId) {
                    $quantity = rand(1, 5);
                    $this->orderItems
                        ->insert(
                            [
                                'order_id' => $lastOrderId,
                                'item_id' => $itemId,
                                'quantity' => $quantity,
                            ]
                        )
                        ->save();
                }
            }

            echo "$orderCountPerDay orders at $date\n";
        }
    }

    function getUniqueRandomNumbersWithinRange($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);

        return array_slice($numbers, 0, $quantity);
    }
}
