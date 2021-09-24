<?php

namespace Database\Seeders\BackupData;

use App\Models\GizeChannel;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class GizeChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gize_channels = [
            [
                "id" => 1,
                "name" => "የመጽሐፈ አድሜስ የጥበብ ማጋራት ኮርሶች",
                "name_en" => "Book of Addmes Wisdom Sharing Courses",
                "slug" => "Addmes",
                "producer" => "Addmesh Book Trading",
                "banner_image_url" => "images/c/banner.jpg",
                "logo_image_url" => "images/c/logo.jpg",
                "description" => "የመጽሐፈ አድሜስ የጥበብን ማጋራት ኮርስ በ Zoom እና በጊዜ መተግበሪያ https://gize.mezagebtnet.com ላይ በመደበኝነት የሚቀርብ ጥልቅ የሆነ የማዕከለ-ሰብ ጥንታዊ ጥበብ ነው፡፡ የመጽሐፈ አድሜስ አዘጋጅና አቅራቢ ደራሲ ጤንነት ሰጠኝ (ወ/ሩፋኤል) ሲሆን፤ ይኽ መጸሐፍ በተለያዩ ርዕሶች ጥቂት በጥቂቱ በመጸሐፍት እንዲሁም በተለያዩ የትንታኔ መስጫ መንገዶች (Zoom እና ጊዜ መተግበሪያን ጨምሮ) ወደ ሰው ልጆች እንዲደርስ እያደረገ የሚገኘው ደግሞ አድሜሽ መጸሐፍት ንግድ ሥራ ነው፡፡",
                "contact_address" => "Addmesh Book Trading, Addis Ababa, Ethiopia",
                "phone_number" => "(+251) 911 448 945",
                "website" => "https://addmes.mezagebtnet.com/courses",
                "has_batch_videos" => 1,
                "active"=>1,
                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],

            [
                "id" => 2,
                "name" => "ልዩ ልዩ ቪድዮዎች ስብስብ",
                "name_en" => "Special Video Collection",
                "slug" => "collection",
                "producer" => "",
                "banner_image_url" => "images/c/banner_collections.jpg",
                "logo_image_url" => "images/c/gize_logo.png",
                "description" => "በዚህ ቻናል የተለያዩ ቪድዮዎች ለደንበኞቻችን እናቀርባለን። ቪድዮዎቹ በዓይነት የተለያዩ ሆነው እንደ ግጥም፣ አጫጭር ትረካዎች እና ሌሎች ዓይነት ይዘት ይኖራቸዋል፡፡",
                "contact_address" => "Mezagebt Net Office. Addis Ababa, Ethiopia",
                "phone_number" => "(+251) 911 616155 | (+251) 911 922487",
                "website" => "https://gize.mezagebtnet.com",
                "has_batch_videos" => 0,
                "active"=>1,
                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
        ];

        GizeChannel::insert($gize_channels);
        /*
    $faker = Faker::create();
    $categories = ChannelCategory::whereHas('parentCategory.parentCategory')->pluck('id');

    for ($i = 1; $i <= 2; $i++) {
    $gize_channel = GizeChannel::create([
    'name' => $faker->sentence(2),
    'name_en' => $faker->sentence(2),
    // 'owner' => $faker->name($gender = null|'male'|'female'), // ባለቤት
    'producer' => $faker->randomElement([$faker->company(), 'አድሜሽ የመጽሐፍት ንግድ ሥራ']), // አዘጋጅ
    'slug' => $faker->unique()->slug(2),
    'description' =>  $faker->sentence(3),
    'created_at' => Date::now()->format('Y-m-d H:i:s'),
    'updated_at' => Date::now()->format('Y-m-d H:i:s'),
    ]);

    if (count($categories)) {
    $gize_channel->categories()->sync($categories->random(mt_rand(1, 3)));
    }

    }

     */
    }
}
