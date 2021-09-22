<?php

namespace Database\Seeders\BackupData;

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

        $channelvideos = [
            [
                "id"=>"1",
                "title"=>"ሃሳበ አድሜስ - ክፍል 1 (መግቢያ)",
                "trainer"=>"ጤንነት ሰጠኝ (ሩፋኤል)",
                "duration"=>"19 ደቂቃ",
                "price"=>"0.00",
                "description"=>"<p><span><strong>ጥያቄ አንድ፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nማንነት በተለያዩ ስያሜዎች ሊጠራ ይችላል፡፡ አንዳንድ ሰዎች ከሁለት በላይ የሆነ ስም አላቸው፡፡ ታዲያ ይህ ከሆነ ሁለቱን የማንነት ስሞች እንዝዴት ለይተን ልናውቃቸው እንችላለን? የእራስህን ስም ወስደህ በምሳሌ ግለጽ\n</span></p>\n\n\n<p><span><strong>ጥያቄ ሁለት፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nሃሳበ አድሜስ ጥቅል ሃሳብ ነው፡፡ መጽሐፈ አድሜስ ደግሞ ከእዚህ ጥቅል ሃሳብ ወስጥ የተደረሰባቸውና ገና ወደፊት ሊደረስባቸው የሚችሉ ሃሳቦች የሚገኙበት ነው፡፡ በአንተ ውስጥ የራሴ የምትለውና ስያሜ ሰጥተህ እንዲህ ልትገልጸው የምትችላቸው ሀሳቦች ያሉ ይመስልሃል? ካሉ እነዚህን ሃሳቦች ምሳሌ እየጠቀስክ አስረዳን፡፡ \n</span>\n</p>\n\n<p><span><strong>ጥያቄ ሶስት፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nሁለት ማንነቶች በፍጥረታት ሁሉ ዘንድ የሚገኙ ናቸው፡፡ ፍጥረታት የተሳሰሩትም በእነዚህ ሁለት ማንነቶች አማካኝነት ነው፡፡ ለመሆኑ ፍጥረታትን ይህ ሁለት ማንነት እንዴት ሊያስተሳስራቸው ይችላል? ይህንን አንደኛው ፍጥረት ከሌላው ፍጥረት ጋር የተሳሰረበትን ሂደት ምሳሌ እየጠቀስክ አስረዳ፡፡\n</span></p>\n\n<p><span><strong>ጥያቄ አራት፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nሁለት ማንነቶች ማወቅ ሲቀጥልም በመካከላቸው ያለውን ትስስር ማስተዋል ምን ይጠቅማል?\n</span></p>",
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1621326659.jpg",
                "thumb_image_url"=>"images/c/thumb/1621326659.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-04-16 12:56:01",
                "updated_at"=>"2021-08-04 14:26:06"
            ],

            [
                "id"=>"2",
                "title"=>"ሃሳበ አድሜስ  - ክፍል 2 (መግቢያ)",
                "trainer"=>"ጤንነት ሰጠኝ (ሩፋኤል)",
                "duration"=>"31 ደቂቃ",
                "price"=>"0.00",
                "description"=>"<p><span><strong>ጥያቄ አንድ፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nበሰማያተ ዓለም አንድ ቀን በምድራዊ ዓለም 1000 ዓመት ነው። ይህ በሁለቱ ማንነቶች ውስጥ እንዴት ተገልጦ ይመጣል?\n</span></p>\n\n\n<p><span><strong>ጥያቄ ሁለት፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nጊዜ ሂደት ነው፤ ወይም የተዘረጋ ነው ይላል። ለመሆኑ የሁለቱ ማንነቶች የጊዜ ሂደት እንዴት ሊታወቅ ይችላል? \n</span>\n</p>\n\n<p><span><strong>ጥያቄ ሶስት፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nጊዜ ለውጥ ነው። በማይታየው ዓለም ያለው ማንነት በሚታየው ዓለም ያለውን ማንነት እንዴት ሊለውጠው ይችላል? በምሳሌ ስጥተህ አስረዳ።\n</span></p>\n\n<p><span><strong>ጥያቄ አራት፡-</strong></span><br/>\n<span class=\"text-sm ml-4\">\nጊዜ እንቅስቃሴ ነው። በሚታየው ዓለም ያለው ማንነት እንቅስቃሴ ማይታየው ዓለም የተያዘ መሆኑን በምን ልናውቅ እንችላለን? ምሳሌ እየሰጠህ ለማስረዳት ሞክር።\n</span></p>",
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1621302336.jpg",
                "thumb_image_url"=>"images/c/thumb/1621302336.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-05-06 07:09:22",
                "updated_at"=>"2021-08-04 14:26:04"
            ],

            [
                "id"=>"3",
                "title"=>"ሃሳበ አድሜስ - ክፍል 3 (መግቢያ)",
                "trainer"=>"ጤንነት ሰጠኝ (ሩፋኤል)",
                "duration"=>"19 ደቂቃ",
                "price"=>"0.00",
                "description"=>"<p><span></span><br/>\n<span class=\"text-sm ml-4 text-white\">\n. ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ ።\n</span></p>",
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1621328859.jpg",
                "thumb_image_url"=>"images/c/thumb/1621328859.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-05-15 13:06:06",
                "updated_at"=>"2021-08-04 14:26:01"
            ],

            [
                "id"=>"4",
                "title"=>"ሃሳበ አድሜስ  - ክፍል 4 (መግቢያ)",
                "trainer"=>"ጤንነት ሰጠኝ (ሩፋኤል)",
                "duration"=>"30 ደቂቃ",
                "price"=>"0.00",
                "description"=>"<p><span></span><br/>\n<span class=\"text-sm ml-4 text-white\">\n. ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ . ... .... ....... ............ ።\n</span></p>",
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1621767186.jpg",
                "thumb_image_url"=>"images/c/thumb/1621767186.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-05-23 10:51:57",
                "updated_at"=>"2021-08-04 14:25:59"
            ],

            [
                "id"=>"5",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 1",
                "trainer"=>"ጤንነት ሰጠኝ (ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1627122500.jpg",
                "thumb_image_url"=>"images/c/thumb/1627122500.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-07-23 14:55:46",
                "updated_at"=>"2021-09-19 14:55:19"
            ],

            [
                "id"=>"6",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 2",
                "trainer"=>"ጤንነት ሰጠኝ (ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1627122475.jpg",
                "thumb_image_url"=>"images/c/thumb/1627122475.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-07-23 15:29:49",
                "updated_at"=>"2021-09-19 14:55:22"
            ],

            [
                "id"=>"7",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 3",
                "trainer"=>"ጤንነት ሰጠኝ (ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1627122455.jpg",
                "thumb_image_url"=>"images/c/thumb/1627122455.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-07-23 15:32:45",
                "updated_at"=>"2021-09-19 14:55:24"
            ],

            [
                "id"=>"8",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 4",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1627476371.jpg",
                "thumb_image_url"=>"images/c/thumb/1627476371.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-07-28 12:46:11",
                "updated_at"=>"2021-09-16 17:04:25"
            ],

            [
                "id"=>"9",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 5",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1627476422.jpg",
                "thumb_image_url"=>"images/c/thumb/1627476422.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-07-28 12:47:02",
                "updated_at"=>"2021-09-17 04:50:33"
            ],

            [
                "id"=>"10",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 6",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1627476427.jpg",
                "thumb_image_url"=>"images/c/thumb/1627476427.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-07-28 12:47:08",
                "updated_at"=>"2021-09-17 04:50:36"
            ],

            [
                "id"=>"11",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 7",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1628081225.jpg",
                "thumb_image_url"=>"images/c/thumb/1628081225.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-04 12:47:05",
                "updated_at"=>"2021-09-17 17:39:55"
            ],

            [
                "id"=>"12",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 8",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1628081242.jpg",
                "thumb_image_url"=>"images/c/thumb/1628081242.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-04 12:47:22",
                "updated_at"=>"2021-09-17 17:39:51"
            ],

            [
                "id"=>"13",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 9",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1628081491.jpg",
                "thumb_image_url"=>"images/c/thumb/1628081491.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-04 12:51:31",
                "updated_at"=>"2021-09-17 17:39:58"
            ],

            [
                "id"=>"15",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 10",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1628684382.jpg",
                "thumb_image_url"=>"images/c/thumb/1628684382.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-11 12:19:43",
                "updated_at"=>"2021-09-18 14:54:05"
            ],

            [
                "id"=>"16",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 11",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1628684409.jpg",
                "thumb_image_url"=>"images/c/thumb/1628684409.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-11 12:20:10",
                "updated_at"=>"2021-09-18 14:54:07"
            ],

            [
                "id"=>"17",
                "title"=>"የመጽሐፈ አድሜስ የመግቢያ ትንታኔ - ክፍል 12",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1628684477.jpg",
                "thumb_image_url"=>"images/c/thumb/1628684477.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-11 12:21:17",
                "updated_at"=>"2021-09-18 14:54:08"
            ],

            [
                "id"=>"18",
                "title"=>"ፍጥረተ ህቡአት  - መግቢያ (ክፍል 1)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629275445.jpg",
                "thumb_image_url"=>"images/c/thumb/1629275445.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-18 08:29:32",
                "updated_at"=>"2021-09-05 14:57:26"
            ],

            [
                "id"=>"19",
                "title"=>"ፍጥረተ ህቡአት  - መግቢያ (ክፍል 2)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629275509.jpg",
                "thumb_image_url"=>"images/c/thumb/1629275509.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-18 08:31:49",
                "updated_at"=>"2021-09-05 14:57:23"
            ],

            [
                "id"=>"20",
                "title"=>"ፍጥረተ ህቡአት  - መግቢያ (ክፍል 3)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629275514.jpg",
                "thumb_image_url"=>"images/c/thumb/1629275514.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-18 08:31:55",
                "updated_at"=>"2021-09-05 14:57:23"
            ],

            [
                "id"=>"21",
                "title"=>"ፍጥረተ ህቡአት  - መግቢያ (ክፍል 4)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629275546.jpg",
                "thumb_image_url"=>"images/c/thumb/1629275546.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-18 08:32:26",
                "updated_at"=>"2021-09-05 14:57:29"
            ],

            [
                "id"=>"22",
                "title"=>"የኃይል ማዕከል - (ክፍል 1)  **ከክፍያ ነፃ**",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629374236.jpg",
                "thumb_image_url"=>"images/c/thumb/1629374236.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-19 11:51:14",
                "updated_at"=>"2021-09-07 17:28:13"
            ],

            [
                "id"=>"23",
                "title"=>"የኃይል ማዕከል - (ክፍል 2)  **ከክፍያ ነፃ**",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629374055.jpg",
                "thumb_image_url"=>"images/c/thumb/1629374055.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-19 11:51:43",
                "updated_at"=>"2021-09-07 17:28:12"
            ],

            [
                "id"=>"24",
                "title"=>"የኃይል ማዕከል - (ክፍል 3)  **ከክፍያ ነፃ**",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629374036.jpg",
                "thumb_image_url"=>"images/c/thumb/1629374036.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-19 11:51:43",
                "updated_at"=>"2021-09-07 17:28:11"
            ],

            [
                "id"=>"25",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 1)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629889802.jpg",
                "thumb_image_url"=>"images/c/thumb/1629889802.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-25 11:10:02",
                "updated_at"=>"2021-09-05 14:57:10"
            ],

            [
                "id"=>"26",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 2)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629889810.jpg",
                "thumb_image_url"=>"images/c/thumb/1629889810.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-25 11:10:10",
                "updated_at"=>"2021-09-05 14:57:11"
            ],

            [
                "id"=>"27",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 3)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1629889963.jpg",
                "thumb_image_url"=>"images/c/thumb/1629889963.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-08-25 11:12:43",
                "updated_at"=>"2021-09-05 14:57:11"
            ],

            [
                "id"=>"29",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 4)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1630503443.jpg",
                "thumb_image_url"=>"images/c/thumb/1630503443.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-01 12:48:42",
                "updated_at"=>"2021-09-07 17:28:27"
            ],

            [
                "id"=>"30",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 5)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1630503417.jpg",
                "thumb_image_url"=>"images/c/thumb/1630503417.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-01 13:34:39",
                "updated_at"=>"2021-09-07 17:28:27"
            ],

            [
                "id"=>"31",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 6)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1630503393.jpg",
                "thumb_image_url"=>"images/c/thumb/1630503393.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-01 13:34:54",
                "updated_at"=>"2021-09-07 17:28:30"
            ],

            [
                "id"=>"32",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 7)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1631106680.jpg",
                "thumb_image_url"=>"images/c/thumb/1631106680.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-08 13:11:20",
                "updated_at"=>"2021-09-16 15:21:08"
            ],

            [
                "id"=>"33",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 8)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1631106754.jpg",
                "thumb_image_url"=>"images/c/thumb/1631106754.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-08 13:12:34",
                "updated_at"=>"2021-09-16 15:21:06"
            ],

            [
                "id"=>"34",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 9)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1631106807.jpg",
                "thumb_image_url"=>"images/c/thumb/1631106807.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-08 13:13:28",
                "updated_at"=>"2021-09-16 15:21:04"
            ],

            [
                "id"=>"35",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 10)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1631106859.jpg",
                "thumb_image_url"=>"images/c/thumb/1631106859.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-08 13:14:20",
                "updated_at"=>"2021-09-16 15:21:03"
            ],

            [
                "id"=>"36",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 11)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"15 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1631708504.jpg",
                "thumb_image_url"=>"images/c/thumb/1631708504.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-15 09:29:10",
                "updated_at"=>"2021-09-19 14:55:01"
            ],

            [
                "id"=>"37",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 12)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1631708483.jpg",
                "thumb_image_url"=>"images/c/thumb/1631708483.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-15 09:29:25",
                "updated_at"=>"2021-09-19 14:55:05"
            ],

            [
                "id"=>"38",
                "title"=>"ፍጥረተ ህቡአት (ክፍል 13)",
                "trainer"=>"ጤንነት ሰጠኝ (ወ/ሩፋኤል)",
                "duration"=>"16 ደቂቃ",
                "price"=>"0.00",
                "description"=>null,
                "category_id"=>null,
                "file_url"=>null,
                "hls_uploaded"=>"1",
                "keys_uploaded"=>"1",
                "storage_disk"=>null,
                "file_type"=>"0",
                "sample_file_url"=>null,
                "sample_file_type"=>"0",
                "poster_image_url"=>"images/c/1631708444.jpg",
                "thumb_image_url"=>"images/c/thumb/1631708444.jpg",
                "gize_channel_id"=> 1,
                "active"=>"0",
                "created_at"=>"2021-09-15 09:29:38",
                "updated_at"=>"2021-09-19 14:55:08"
            ]
        ];
        Channelvideo::insert($channelvideos);

        // $faker = Faker::create();
        // $channelvideo_category_ids = ChannelvideoCategory::whereHas('parentCategory.parentCategory')->pluck('id');


        /*
        $gize_channels = GizeChannel::all();

        $gize_channels->each(function (GizeChannel $gc) use ($faker, $gize_channels, $channelvideo_category_ids) {
            for ($i = 1; $i <= $faker->numberBetween(1, 24); $i++) {


                $channelvideo = Channelvideo::create([
                    'title' => $faker->words(3, true),
                    'trainer' => 'ጤንነት ሰጠኝ (ሩፋኤል)',
                    'duration' => $faker->randomDigitNot(0) . ' ደቂቃ',
                    'host' => $faker->name('male'),  // አቅራቢ
                    'price' => 0.00,
                    'description' => $faker->paragraph,
                    'category_id' => null,
                    'file_url' => null,
                    'hls_uploaded' => 1,
                    'keys_uploaded' => 1,
                    'video_available_for' => $faker->randomElement([0, 1, 2]),
                    'is_free' => $faker->randomElement([0, 1]),
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
        */

    }
}
