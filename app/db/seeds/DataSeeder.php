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
    private string $today;

    public function run()
    {
        $this->today = date('Y-m-d');

        $this->setTables();
        $this->truncateTables();

        $faker = Faker\Factory::create();
        $this->createCountries($faker);
        $this->createDevices($faker);
        $customerIds = $this->createCustomers($faker);
        $this->createItems($faker);
        $this->createOrders($customerIds);
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

    private function createCustomers(\Faker\Generator $faker): array
    {
        $customerIds = [];
        for ($day = 365; $day > 0; $day--) {
            $daysInAgo = date('Y-m-d', strtotime($this->today . " - $day days"));
            $customerCountPerDay = rand(1, 30);
            for ($i = 1; $i <= $customerCountPerDay; $i++) {
                $hour = rand(0, 23);
                $minute = rand(0, 59);
                $seconds = rand(0, 59);
                $createdAt = $daysInAgo . " $hour:$minute:$seconds";

                $this->customers
                    ->insert(
                        [
                            'first_name' => $faker->firstName,
                            'last_name' => $faker->lastName,
                            'email' => $faker->email,
                            'created_at' => $createdAt,
                        ]
                    )
                    ->save();

                $customerIds[] = $this->getAdapter()->getConnection()->lastInsertId();
            }

            echo "$customerCountPerDay customers at $this->today\n";
        }

        return $customerIds;
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

    private function createOrders(array $customerIds)
    {
        for ($day = 365; $day > 0; $day--) {
            $daysInAgo = date('Y-m-d', strtotime($this->today . " - $day days"));
            $orderCountPerDay = rand(1, 30);

            // create orders
            for ($i = 1; $i <= $orderCountPerDay; $i++) {
                $customerId = rand(1, count($customerIds));
                $countryId = rand(1, self::BASE_DATA_LIMIT);
                $deviceId = rand(1, self::BASE_DATA_LIMIT);

                $hour = rand(0, 23);
                $minute = rand(0, 59);
                $seconds = rand(0, 59);
                $purchaseAt = $daysInAgo . " $hour:$minute:$seconds";

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

            echo "$orderCountPerDay orders at $this->today\n";
        }
    }

    function getUniqueRandomNumbersWithinRange($min, $max, $quantity)
    {
        $numbers = range($min, $max);
        shuffle($numbers);

        return array_slice($numbers, 0, $quantity);
    }
}
