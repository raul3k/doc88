<?php

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Order::all()->count() > 0) {
            return null;
        }

        collect([
            [
                'client_id' => 1,
                'pastel_id' => 1,
            ],
            [
                'client_id' => 1,
                'pastel_id' => 2,
            ],
            [
                'client_id' => 1,
                'pastel_id' => 3,
            ],
        ])->each(fn($data) => Order::create($data));
    }
}
