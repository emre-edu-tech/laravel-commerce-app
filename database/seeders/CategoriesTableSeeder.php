<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reis = new Category();
        $reis->parent_id = 0;
        $reis->name = "Reis";
        $reis->description = "Reis, Türkiye'den dünyaya yayılan global bir kuru gıda markasıdır. Çiftçilerimizin el emeği göz nuru olan pirinç ve bakliyat üretimleri, “Reis” markası ile 4 kıtada 26 ülkeye ihraç edilir.";
        $reis->slug = "reis";

        $reis->save();

		$mbirlik = new Category();
        $mbirlik->parent_id = 0;
        $mbirlik->name = "Marmarabirlik";
        $mbirlik->description = "ZEYTİN denince ilk akla gelen MARMARABİRLİK, adını aldığı Marmara Denizi'nin Güney sahilleri boyunca doğuda İznik Gölü çevresinden, batıda Trakya'da Mürefte'ye kadar uzanan bir yay içerisinde konuşlanmıştır.";
        $mbirlik->slug = "mbirlik";

        $mbirlik->save();

		$oncu = new Category();
        $oncu->parent_id = 0;
        $oncu->name = "Öncü";
        $oncu->description = "1970 yılında Gaziantep'in yerli halkından rahmetli İbrahim Halil Kozlu ve 5 oğlunun (Fahrettin, Hasan, Mustafa, M. Hanifi ve Bilal Kozlu) birlikteliğiyle salça alım satımıyla salça ticaretine başlanılmış ve böylece Öncü salçanın ilk temelleri atılmış olur.";
        $oncu->slug = "oncu";

        $oncu->save();
    }
}
