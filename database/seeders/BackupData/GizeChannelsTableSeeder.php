<?php

namespace Database\Seeders\BackupData;

use App\Models\ChannelCategory;
use App\Models\GizeChannel;
use Faker\Factory as Faker;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\Company;
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
            "id" => 1,
            "name" => "የመጽሐፈ አድሜስ የጥበብ ማጋራት ኮርሶች",
            "name_en" => "Book of Addmes Wisdom Sharing Courses",
            "slug" => "Addmes",
            "producer" => "Addmesh Book Trading",
            "banner_image_url" => "images\/c\/1\/banner.jpg",
            "logo_image_url" => "images\/c\/1\/logo.jpg",
            "description" => "የመጽሐፈ አድሜስ የጥበብን ማጋራት ኮርስ በ Zoom እና በጊዜ መተግበሪያ https://gize.mezagebtnet.com ላይ በመደበኝነት የሚቀርብ ጥልቅ የሆነ የማዕከለ-ሰብ ጥንታዊ ጥበብ ነው፡፡ የመጽሐፈ አድሜስ አዘጋጅና አቅራቢ ደራሲ ጤንነት ሰጠኝ (ወ/ሩፋኤል) ሲሆን፤ ይኽ መጸሐፍ በተለያዩ ርዕሶች ጥቂት በጥቂቱ በመጸሐፍት እንዲሁም በተለያዩ የትንታኔ መስጫ መንገዶች (Zoom እና ጊዜ መተግበሪያን ጨምሮ) ወደ ሰው ልጆች እንዲደርስ እያደረገ የሚገኘው ደግሞ አድሜሽ መጸሐፍት ንግድ ሥራ ነው፡፡",
            "contact_address" => "Addmesh Book Trading, Addis Ababa, Ethiopia",
            "phone_number" => "(+251) 911 448 945",
            "website" => "https://addmes.mezagebtnet.com/courses",
            'created_at' => Date::now()->format('Y-m-d H:i:s'),
            'updated_at' => Date::now()->format('Y-m-d H:i:s'),
            'deleted_at' => null,
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
