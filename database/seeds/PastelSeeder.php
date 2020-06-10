<?php

use Illuminate\Database\Seeder;
use App\Models\Pastel;

class PastelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Pastel::all()->count() > 0) {
            return null;
        }

        collect([
            [
                'name' => 'Pastel de frango',
                'price' => 5.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
            [
                'name' => 'Pastel de carne',
                'price' => 5.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
            [
                'name' => 'Pastel de queijo',
                'price' => 5.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
            [
                'name' => 'Pastel de frango com catupiry',
                'price' => 7.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
            [
                'name' => 'Pastel de carne com chedder',
                'price' => 7.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
            [
                'name' => 'Pastel de calabresa com catupiry',
                'price' => 7.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
            [
                'name' => 'Pastel especial de carne',
                'price' => 10.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
            [
                'name' => 'Pastel especial de frango',
                'price' => 10.0,
                'photo' => 'pastel/pastel_default.jpg',
            ],
        ])->each(fn($pastel) => Pastel::create($pastel));
    }
}
