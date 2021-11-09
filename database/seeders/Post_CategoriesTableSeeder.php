<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\PostCategory;

class Post_CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$yemek_tarifleri = new PostCategory();
       	$yemek_tarifleri->parent_category_id = 0;
       	$yemek_tarifleri->name = 'Yemek Tarifleri';
       	$yemek_tarifleri->description = 'Sayfamızda her yöreden yemek tariflerini bulabilirsiniz. Bugün ne pişirsem sorunuza en hazır cevapları vermek için buradayız. Nefis yemek tarifleri arıyorsanız doğru adrestesiniz. Dervişoğlu aracılığıyla aldığınız ürünleri kullanarak Türk Mutfağı\'nın en seçkin örneklerini mutfağınızda deneyebilirsiniz.';
       	$yemek_tarifleri->save();

       	$yasam = new PostCategory();
       	$yasam->parent_category_id = 0;
       	$yasam->name = 'Yaşam';
       	$yasam->description = 'Hayatınızı kolaylaştıran pratik fikirler, daha mutlu ve sağlıklı bir yaşam için öğrenmek isteyeceğiniz faydalı bilgiler burada. Evcil hayvanlarınızın bakımına yardımcı olabilecek bilgiler bile bu sayfada. Yaşam sayfamız günlük yaşamınızda sorduğunuz "Evde nasıl sebze yetiştirebilirim? Salça en iyi nasıl saklanır? gibi sorulara cevap bulabileceğiniz bir ortam.';
       	$yasam->save();

       	$ozel_gunler = new PostCategory();
       	$ozel_gunler->parent_category_id = 0;
       	$ozel_gunler->name = "Özel Günler";
       	$ozel_gunler->description = 'İftarda ya da akrabalarınızla bir bayram sofrasında misafirleriniz için hazırlayabileceğiniz özel tarifler, sofranıza renk katacak baharatlar hep elinizin altında. Özel Günler sayfasını kullanarak hazırlıklara başlayın.';
       	$ozel_gunler->save();
    }
}
