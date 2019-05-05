<?php

use Illuminate\Database\Seeder;
use App\BoxType;

class Box_TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket12 = new BoxType();
        $paket12->unit_number_in_box = 12;
        $paket12->description = 'Aynı üründen içinde 12 tane bulunan kutu ya da koli';

        $paket12->save();

		$paket6 = new BoxType();
        $paket6->unit_number_in_box = 6;
        $paket6->description = 'Aynı üründen içinde 12 tane bulunan kutu ya da koli';

        $paket6->save();
    }
}
