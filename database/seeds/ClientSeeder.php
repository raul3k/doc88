<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Client::all()->count() > 0) {
            return null;
        }

        Client::create([
            'name' => 'Client 1',
            'email' => 'client1@email.com',
            'telephone' => '11948778796',
            'birthdate' => '1990-05-12',
            'address' => 'Rua 1',
            'complement' => 'Casa 2',
            'neighborhood' => 'Bairro 2',
            'zipcode' => '04877987',
        ]);
    }
}
