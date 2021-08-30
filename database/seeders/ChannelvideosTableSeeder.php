<?php

namespace Database\Seeders;

use App\Models\Channelvideo;
use App\Models\ChannelvideoCategory;
use App\Models\GizeChannel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class ChannelvideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $channelvideos = [
        //     [
        //         'id' => 1,
        //         'title' => 'ሃሳበ አድሜስ - ክፍል 1 (መግቢያ)',
        //         'trainer' => 'ጤንነት ሰጠኝ (ሩፋኤል)',
        //         'duration' => '19 ደቂቃ',
        //         'price' => 0.00,
        //         'description' => '<p><span><strong>ጥያቄ አንድ፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         ማንነት በተለያዩ ስያሜዎች ሊጠራ ይችላል፡፡ አንዳንድ ሰዎች ከሁለት በላይ የሆነ ስም አላቸው፡፡ ታዲያ ይህ ከሆነ ሁለቱን የማንነት ስሞች እንዝዴት ለይተን ልናውቃቸው እንችላለን? የእራስህን ስም ወስደህ በምሳሌ ግለጽ
        //         </span></p>

        //         <p><span><strong>ጥያቄ ሁለት፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         ሃሳበ አድሜስ ጥቅል ሃሳብ ነው፡፡ መጽሐፈ አድሜስ ደግሞ ከእዚህ ጥቅል ሃሳብ ወስጥ የተደረሰባቸውና ገና ወደፊት ሊደረስባቸው የሚችሉ ሃሳቦች የሚገኙበት ነው፡፡ በአንተ ውስጥ የራሴ የምትለውና ስያሜ ሰጥተህ እንዲህ ልትገልጸው የምትችላቸው ሀሳቦች ያሉ ይመስልሃል? ካሉ እነዚህን ሃሳቦች ምሳሌ እየጠቀስክ አስረዳን፡፡
        //         </span>
        //         </p>

        //         <p><span><strong>ጥያቄ ሶስት፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         ሁለት ማንነቶች በፍጥረታት ሁሉ ዘንድ የሚገኙ ናቸው፡፡ ፍጥረታት የተሳሰሩትም በእነዚህ ሁለት ማንነቶች አማካኝነት ነው፡፡ ለመሆኑ ፍጥረታትን ይህ ሁለት ማንነት እንዴት ሊያስተሳስራቸው ይችላል? ይህንን አንደኛው ፍጥረት ከሌላው ፍጥረት ጋር የተሳሰረበትን ሂደት ምሳሌ እየጠቀስክ አስረዳ፡፡
        //         </span></p>

        //         <p><span><strong>ጥያቄ አራት፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         ሁለት ማንነቶች ማወቅ ሲቀጥልም በመካከላቸው ያለውን ትስስር ማስተዋል ምን ይጠቅማል?
        //         </span></p>',
        //         'category_id' => null,
        //         'file_url' => '1620138082.zip',
        //         'hls_uploaded' => 1,
        //         'keys_uploaded' => 1,
        //         'storage_disk' => null,
        //         'file_type' => 0,
        //         'sample_file_url' => null,
        //         'sample_file_type' => 0,
        //         'poster_image_url' => 'images/l/1618582089.jpg',
        //         'thumb_image_url' => 'images/l/thumb/1618582089.jpg',
        //         'created_at' => '2021-04-16 14:08:09',
        //         'updated_at' => '2021-05-18 02:01:11',
        //         'active' => 1,
        //     ],
        //     [
        //         'id' => 2,
        //         'title' => 'ሃሳበ አድሜስ - ክፍል 2 (መግቢያ)',
        //         'trainer' => 'ጤንነት ሰጠኝ (ሩፋኤል)',
        //         'duration' => '31 ደቂቃ',
        //         'price' => 0.00,
        //         'description' => '<p><span><strong>ጥያቄ አንድ፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         በሰማያተ ዓለም አንድ ቀን በምድራዊ ዓለም 1000 ዓመት ነው። ይህ በሁለቱ ማንነቶች ውስጥ እንዴት ተገልጦ ይመጣል?
        //         </span></p>

        //         <p><span><strong>ጥያቄ ሁለት፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         ጊዜ ሂደት ነው፤ ወይም የተዘረጋ ነው ይላል። ለመሆኑ የሁለቱ ማንነቶች የጊዜ ሂደት እንዴት ሊታወቅ ይችላል?
        //         </span>
        //         </p>

        //         <p><span><strong>ጥያቄ ሶስት፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         ጊዜ ለውጥ ነው። በማይታየው ዓለም ያለው ማንነት በሚታየው ዓለም ያለውን ማንነት እንዴት ሊለውጠው ይችላል? በምሳሌ ስጥተህ አስረዳ።
        //         </span></p>

        //         <p><span><strong>ጥያቄ አራት፡-</strong></span><br/>
        //         <span class="text-sm ml-4">
        //         ጊዜ እንቅስቃሴ ነው። በሚታየው ዓለም ያለው ማንነት እንቅስቃሴ ማይታየው ዓለም የተያዘ መሆኑን በምን ልናውቅ እንችላለን? ምሳሌ እየሰጠህ ለማስረዳት ሞክር።
        //         </span></p>',
        //         'category_id' => null,
        //         'file_url' => null,
        //         'hls_uploaded' => 1,
        //         'keys_uploaded' => 1,
        //         'storage_disk' => null,
        //         'file_type' => 0,
        //         'sample_file_url' => null,
        //         'sample_file_type' => 0,
        //         'poster_image_url' => 'images/l/1621084394.jpg',
        //         'thumb_image_url' => 'images/l/thumb/1621084394.jpg',
        //         'created_at' => '2021-05-05 10:15:14',
        //         'updated_at' => '2021-05-18 02:17:17',
        //         'active' => 1,
        //     ],

        //     [
        //         'id' => 3,
        //         'title' => 'ሃሳበ አድሜስ - ክፍል 3 (መግቢያ)',
        //         'trainer' => 'ጤንነት ሰጠኝ (ሩፋኤል)',
        //         'duration' => '19 ደቂቃ',
        //         'price' => 0.00,
        //         'description' => '<p><span><strong>ጥያቄ፡-</strong></span><br/>
        //         <span class="text-sm ml-4 text-white">
        //         . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ [የዚህ ቪድዮ ጥያቄዎች በሚቀጥለው ቀን ይቀመጡልዎታል።]
        //         </span></p>',
        //         'category_id' => null,
        //         'file_url' => null,
        //         'hls_uploaded' => 1,
        //         'keys_uploaded' => 1,
        //         'storage_disk' => null,
        //         'file_type' => 0,
        //         'sample_file_url' => null,
        //         'sample_file_type' => 0,
        //         'poster_image_url' => 'images/l/1621084506.jpg',
        //         'thumb_image_url' => 'images/l/thumb/1621084506.jpg',
        //         'created_at' => '2021-05-15 13:15:07',
        //         'updated_at' => '2021-05-23 11:47:10',
        //         'active' => 1,
        //     ],
        // ];

        // Channelvideo::insert($channelvideos);

        $faker = Faker::create();
        $channelvideo_category_ids = ChannelvideoCategory::whereHas('parentCategory.parentCategory')->pluck('id');

        $gize_channels = GizeChannel::all();

        $gize_channels->each(function (GizeChannel $gc) use ($faker, $gize_channels, $channelvideo_category_ids) {
            for ($i = 1; $i <= $faker->numberBetween(1, 24); $i++) {

                $channelvideo = Channelvideo::create([
                    'title' => $faker->sentence(3),
                    'trainer' => 'ጤንነት ሰጠኝ (ሩፋኤል)',
                    'duration' => $faker->randomDigitNot(0) . ' ደቂቃ',
                    'host' => $faker->name('male'),  // አቅራቢ
                    'price' => 0.00,
                    'description' => $faker->paragraph,
                    'category_id' => null,
                    'file_url' => null,
                    'hls_uploaded' => 1,
                    'keys_uploaded' => 1,
                    'storage_disk' => null,
                    'file_type' => 0,
                    'sample_file_url' => null,
                    'sample_file_type' => 0,
                    'poster_image_url' => null,
                    'thumb_image_url' => null,
                    'created_at' => $faker->date() . ' ' . $faker->time(),
                    'updated_at' => $faker->date() . ' ' . $faker->time(),
                    'active' => (int) $faker->boolean,
                    'gize_channel_id' => $faker->randomElement($gize_channels->pluck('id')),
                ]);

                // $channelvideo->gizeChannel()->associate($gc);
                if (count($channelvideo_category_ids)) {
                    $channelvideo->channelvideoCategories()->syncWithoutDetaching($faker->randomElements($channelvideo_category_ids, mt_rand(1, 3)));
                }
                // $channelvideo->save();
                // $inserted->channelvideoCategories()->syncWithoutDetaching($faker->randomElement($channelvideo_category_ids));
            }
        });

    }
}
