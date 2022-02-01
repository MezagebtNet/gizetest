<?php

namespace Database\Seeders\FactorySettings;

use App\Models\Collection;
use App\Models\CollectionType;
use Illuminate\Database\Seeder;

class CollectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $collections = [
            [
                'id' => 1,
                'parent_id' => null,
                'collection_type_id' => 2, // Book
                'title' => 'መጽሐፈ ፍጥረተ ህቡአት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:30:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => 'በጥቅሉ ስለ ነገረ ፍጥረት የሚተርክ መጽሐፍ ነው። የፍጥረታትን አመጣጥ፣ አፈጣጠርና በጊዜ ስር ያላቸውን ሂደት ከመነሻው ጀምሮ የሚተርክ መጽሐፍ ነው።',
                'poster_image_url' => 'images/col/Fitrete_Hebuat_1.png',
                'thumb_image_url' => 'images/col/thumb/Fitrete_Hebuat_1.png',
                'slug'=> 'fetrete-hebuat-book-1',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 2,
                'parent_id' => 1,
                'collection_type_id' => 4, // Preface
                'title' => 'ሃሳበ አድሜስ፣ መጽሐፈ አድሜስ',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:15:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 0,
                'series_no' => 1,
                'description' => 'description',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'collection_type_id' => 5, // Introduction
                'title' => '',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:15:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 0,
                'series_no' => 1,
                'description' => 'ሃሳበ አድሜስም ሆነ መጽሐፈ አድሜስ በዚህ ዘመን ለሚገኝ ትውልድ ተገልጦ የመጣ ጥበብ ነው፡፡ ይኽ ሃሳብ ለትውልዱ የመጣ
                ቢሆንም፤ ከእዚህ ከመጣ ሃሳብ በመጀመሪያ
                የደረሰውና የገለጠው የመጽሐፈ አድሜስ አዘጋጅና ደራሲ የሆነው ጤንነት ሰጠኝ /ወልደ ሩፋኤል/ ነው፡፡ ይኽም ጥበብ በመጽሐፍትና
                በተለያዩ የትንታኔ መስጫ መንገዶች ከሰው ልጆች ዘንድ እንዲደርስ እየሰራ የሚገኘው ደግሞ አድሜሽ መጽሐፍት ንግድ ሥራ ነው፡፡
                በመጽሐፈ አድሜስ ስር ተካትተው በአማረኛ እንዲሁም በእንግሊዘኛ ቋንቋ ተትርጉመው ወደ ሰው ልጆች የደረሱት እና ወደ ፊት
                ለኅትመት የሚበቁት መጽሐፍት በአራት ዋና ዋና ክፍል ተቀምጠዋል፡፡
                እነዚህም፡-<br/>
                1. መጽሐፈ ፍጥረተ-ህቡአት፣<br/>
                2. መጽሐፈ ምልአ ውህደት፣<br/>
                3. መጽሐፈ ንግርተ ካህዝን እና<br/>
                4. መጽሐፈ ጥበብ፣<br/>
                የተሰኙ ታላላቅ መጽሐፍት ናቸው፡፡<br/>
                በዚህ የመግቢያ ትንታኔ ቪዲዮ የፍጥረታትን አፈጣጠር የሚያክል ሰፊና ጥልቅ ጉዳይ አነስተኛ መጠን ባለው የፍጥረተ-ህቡአት
                መጽሐፍ ውስጥ ተካትቶ የመቅረቡ ነገር እንዴት እንደሆነ ትንታኔ ቀርቦበታል፡፡<br/>
                በተጨማሪም ፍጥረተ ህቡዓት ከዚህ በፊት ከጥበብ ሰዎች ያልተሰሙ ወይም ተፅፈው ያልተገኙ ታላላቅ ምስጢራት፣ እንዲሁም እንደ
                መጽሐፍ ሔኖክ የመሳሰሉ የጥበብ መጽሐፍት ያነሷቸውን እና ሳያነሱ የተዋቸውን የጥበብ ሃሳቦች በዚህ ዘመን የሚገኝ ትውልድ
                ሊረዳው በሚችል መንገድ የቀረበበት መጽሐፍ መሆኑን ያስረዳል።<br/>',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 4,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ዓለማት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:15:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => 'description',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 5,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ሰማያተ ዓለም',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:15:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 2,
                'description' => 'description',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 6,
                'parent_id' => null,
                'collection_type_id' => 2, // Book
                'title' => 'መጽሐፈ ምልዓ ውህደት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:30:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => 'በጥቅሉ የሰው ልጅ ወደ ምልአ ውህደት እና ምልአ መገለጥ የክብር ደረጃ መድረስ የሚያስችሉትን ምስጢራት የያዘ ወት ይዞ ስለመጣው የሰው ልጅ እና ከዛም በኋላ የእሱ ወገኖች ስለሆኑት የሰው ልጆች የሚተርክ መጽሐፍ ነው።',
                'poster_image_url' => 'images/col/Mela_Wuhdet_1.png',
                'thumb_image_url' => 'images/col/thumb/Mela_Wuhdet_1.png',
                'active'=>1,
                'slug'=> 'mela-wuhdet-book-1',
                'gize_channel_id' => 1,

            ],

            [
                'id' => 7,
                'parent_id' => 6,
                'collection_type_id' => 5, // መግቢያ
                'title' => '',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:15:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 0,
                'series_no' => 1,
                'description' => 'description',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 8,
                'parent_id' => 6,
                'collection_type_id' => 5, // መግቢያ፡ መጽሐፈ ምልዓ ውህደት መጽሐፍ 1
                'title' => 'መጽሐፈ ምልዓ ውህደት መጽሐፍ 1',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:15:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 0,
                'series_no' => 1,
                'description' => 'description',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 9,
                'parent_id' => 6,
                'collection_type_id' => 6, // Chapter
                'title' => '',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:15:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => 'description',
                'gize_channel_id' => 1,
            ],
        ];



        foreach ($collections as $collection) {
            Collection::create($collection);
        }

        // Collection::insert($collections);




        $collection = Collection::find(2);
        $collection->channelvideos()->sync([4, 5]);

    }
}
