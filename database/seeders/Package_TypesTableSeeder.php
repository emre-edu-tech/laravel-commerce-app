<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\PackageType;

class Package_TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poset = new PackageType();
        $poset->name = 'Poşet';
        $poset->description = 'Bulgur, Fasulye, Yeşil Mercimek gibi bakliyatların satıldığı ambalaj bir ambalaj çeşidi';
        $poset->save();

        $dose = new PackageType();
        $dose->name = 'Dose';
        $dose->description = 'El değmeden paketlenen ve daha çok zeytin paketlemesinde kullanılan bir ambalaj çeşidi.';
        $dose->save();
    }
}
