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

            [
                'id' => 10,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ስውራን፣ ህየዋን እና ግዑዛን',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:51:21',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 3,
                'description' => 'በሰማያተ ዓለም የሚገኙ ፍጥረታት ስውራን፣ ህያዋን እና ግዑዛን በሚል በአራት ምድብ ተከፍለው የሚገኙ ናቸው፡፡ እነዚህ ፍጥረታት
                በሰማያተ ዓለም አንድ ቀን የጊዜ ሂደት ውስጥ ምልዓ ውህደት ፈጥረው በአንድነት የሚገኙ ናቸው፡፡ ይኽም ማለት አንደኛው በሌላው
                ውስጥ ሌላኛውም በአንደኛው ውስጥ ይገኛል እንደ ማለት ሲሆን፤ በምድራዊ ዓለም ላይ ያሉ ፍጥረታት የመጡበትና ወደፊትም
                የሚመጡበት ሂደት ይኼንኑ አካሄድ የሚከተል ነው፡፡<br/>
                ይኽ ቪዲዮ ስለ ስውራን፣ ህያዋን እና ግዑዛን ጉዳይ ሰፋ ያለ ማብራሪያ ይሰጥበታል፡፡
                ',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 11,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ክስተት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:47:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 4,
                'description' => 'ክስተት ፍጥረታት ካለመሆን ወደ መሆን የመጡበት ሂደት ነው፡፡ በሰማያት ዓለም አስሩ ፍጥረታት መፈጠራቸው፣ እነዚህ ፍጥረታት
                ምልአ ውህደት መፍጠራቸው፣ በዚህ ምልዓ ውህደት አንድ ቀን የምንለው የጊዜ መጠን መታወቁ እና በዚህ ሂደት ሰማየት ዓለም
                ተለይቶ መታወቁ በጥቅሉ አንድ ክስተት ነው፡፡<br/>
                ይኽ በሰማያተ ዓለም የተፈጠረው ክስተት እውነት ነው፡፡ ይኽ እውነት የፍጥረታት ሁሉ የፍፁምነት ወይም የእውነት ልኬት መጠን
                ስለመሆኑ በዚህ ቪዲዮ ተብራርቶ ቀርቧል፡፡',
                'gize_channel_id' => 1,
            ],


            [
                'id' => 12,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '00:29:37',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 5,
                'description' => 'በሰማየተ ዓለም የመጀመሪያዎቹ የምንላቸው አስር ፍጥረታት በክስተት ከመጡ በኋላ በፍጥረታት መካከል የተከናወነው ለውጥ
                ምን እንደሆነ የሚያስረዳን ትዕይንት ነው፡፡ አስሩ ፍጥረታት ከመጡ በኋላ በሰማየተ ዓለም ስፍራ፣ ስፍራቸውን እስከያዙበት ጊዜ
                ድረስ አስር ታላላቅ ትዕይንቶች ተከናውነዋል፡፡<br/>
                ይኽ ቪዲዮ ክስተትን ሳይለቅ የትዕይንትን ጥቅል ሒደት የሚያብራራ ነው፡፡
                ',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 13,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'የመጀመሪያው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '01:03:46',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 6,
                'description' => 'በሰማየተ ዓለም በመጀመሪያው ትዕይንት ጨለማ በክስተት ከተገኘው ሰማያተ ዓለም በምንለው ሥፍራ ላይ ተገልጦ ታየ፡፡ ጨለማ
                ከግዑዛን ምድብ በክብር ቀዳሚነቱን የሚይዝ ሲሆን፤ አብረውት ብርሃን እና ጨረር ይገኛሉ፡፡ ከስውራን ፍጥረታት መካከል
                በመጀመሪያ የክብር ደረጃ ላይ የሚገኘው ጊዜ ተገልጦ የታበት እና የጊዜ ሂደት መቆጠር የጀመረውም ከዚህ ከጨለማ መገለጥ ጀምሮ
                ነው፡፡<br/>
                በሰማያተ ዓለም የሚገኘው የዚህ ጨለማ ጥልቀቱና መጠኑ ልክ እንደ ጊዜ ሂደት መነሻው እንጂ ፍፃሜው የሚታወቅ አይደለም፡፡<br/>
                በዚህ ቪዲዮ በመጀመሪያው ትዕይንት ስለመጡት ጨለማ፣ ጊዜ እንዲሁም ለውጥና እንቅስቃሴ ዝርዝር ማብራሪያ ቀርቦባቸዋል፡፡
                ',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 14,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ሁለተኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '03:29:04',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 7,
                'description' => 'በሰማየተ ዓለም በመጀመሪያው ትዕይንት ጨለማ በክስተት ከተገኘው ሰማያተ ዓለም በምንለው ሥፍራ ላይ ተገልጦ ታየ፡፡ ጨለማ
                ከግዑዛን ምድብ በክብር ቀዳሚነቱን የሚይዝ ሲሆን፤ አብረውት ብርሃን እና ጨረር ይገኛሉ፡፡ ከስውራን ፍጥረታት መካከል
                በመጀመሪያ የክብር ደረጃ ላይ የሚገኘው ጊዜ ተገልጦ የታበት እና የጊዜ ሂደት መቆጠር የጀመረውም ከዚህ ከጨለማ መገለጥ ጀምሮ
                ነው፡፡<br/>
                በሰማያተ ዓለም የሚገኘው የዚህ ጨለማ ጥልቀቱና መጠኑ ልክ እንደ ጊዜ ሂደት መነሻው እንጂ ፍፃሜው የሚታወቅ አይደለም፡፡<br/>
                በዚህ ቪዲዮ በመጀመሪያው ትዕይንት ስለመጡት ጨለማ፣ ጊዜ እንዲሁም ለውጥና እንቅስቃሴ ዝርዝር ማብራሪያ ቀርቦባቸዋል፡፡<br/>

                ብርሃናት ማለት ቀለማት ማለት ነው፡፡ አንድ ፍጥረት ህልው ሆኖ ታየ ሲባል የራሱን ብርሃን ወይም የራሱን ቀለም ገለጠ ማለት ነው፡፡
                በሌላ በኩል አንድ ፍጥረት ህልው ሆነ ሲባል በ4 አቅጣጫ ተገልጦ ይታያል፣ ያያልም እንደማለት ነው፡፡ ይኽም የሚሆነው ግዝፈት
                በአንድ በኩል አቅጣጫ ማለት ሲሆን፤ በሌላ በኩል አምሳል፣ የተመዘገበ እንዲሁም ማደሪያ ማለት በመሆኑ ነው፡፡<br/>
                በትዕይንት ክፍል 2 ቪዲዮ ስለ ግዝፈት እና ብርሃናት ዝርዝር ማብራሪያ ቀርቦባቸዋል፡፡<br/>

                በሰማያት ዓለም በመጀመሪያው ትዕይንት ከጨለማ ጋር አብረን የምናነሳው ጨረርን ነው፡፡ ጨለማ መሰውር እንደሆነው፣ ብርሃንም
                መገለጥ እንደሆነው ጨረር ደግሞ መክፈቻ ነው፡፡ ግዑዝ ከሆነው ፍጥረት ጀርባ ያለውን እና በማደሪያው ላይ ያረፈውን ገልጦ
                የሚያመጣው ጨረር ነው፡፡ በሌላ በኩል ጊዜ በጨለማ ላይ ተገልጦ እንደሚታየው፣ ግዝፈት በብርሃናት ላይ ተገልጦ እንደሚታየው
                ኃይልም በጨረር ላይ ተገልጦ ይታያል፡፡<br/>
                በዚህ ቪዲዮ ስለ ጨረር እና አብረውት ስላሉት ጉዳዮች ሰፊ ማብራሪያ ቀርቦባቸዋል፡፡<br/>

                ',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 15,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ሦስተኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '03:29:04',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 8,
                'description' => 'መጽሐፈ ፍጥረተ ህቡዓት በመጽሐፈ አድሜስ ስር ለሚገኙት አራቱም መጽሐፍት መሠረት ነው፡፡ በሌላ አገላለፅ በሌሎቹ መጽሐፍት
                ላይ ለሚነሱት ሃሳቦች መነሻ የሚሆኑ መሠረታዊ ጉዳዮች የሚነሱት በፍጥረተ ህቡዓት መጽሐፍ ነው፡፡ ይኽንን ሃሳብ በማብራራት
                ሚጀምረው በዚህ ቪዲዮ ውስጥ ስለ ሶስተኛው ትዕይንት ገለፃ ቀርቦበታል፡፡ ይኸውም ከጉዑዛን ምድብ ስር የሚገኙት አራቱ ባህሪያት
                ተገልጠው መምጣታቸውን የሚያስረዳ ነው፡፡<br/>
                በሰማያተ ዓለም ግዑዛን ከምንላቸው ፍጥረታት መካከል አራቱ ባህሪያት ይገኛሉ፡፡ እነዚህ ባሕሪያት በእሳት፣ በውሃ፣ በንፋስና በአፈር
                ተመስለው ይጠራሉ፡፡ ይኽ ቢባልም አራቱ ባህሪያት እሳት፣ ውሃ፣ ንፋስ እና አፈር ሆነው ሳይሆን የእነዚህ ባህሪይ ያላቸው መሆኑን
                ለማሳየት ነው፡፡<br/>
                በዚህ ቪዲዮ ስለ አራቱ ባህሪያት ዝርዝር ማብራሪያ ቀርቦባቸዋል፡፡
                ',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 16,
                'parent_id' => null,
                'collection_type_id' => 2, // Book
                'title' => 'መጽሐፈ ጥበብ',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => 'ይህ መጽሐፍ የሰው ልጅ በምድራዊ ዓለም ላይ ሳለ ከሚገጥመው መከራና ችግር ተዘሎ በታላቅ ክብር ይቀመጥ ዘንድ የሚረዳ የጥበብ ሥርዓት የያዘ መጽሐፍ ነው።',
                'poster_image_url' => 'images/col/Tibeb_1.png',
                'thumb_image_url' => 'images/col/thumb/Tibeb_1.png',
                'slug'=> 'tibeb-book-1',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 17,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'አራተኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '01:12:00',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 9,
                'description' => 'በሰማያተ ዓለም በመጀመሪያው ቀን ከተፈጠሩት አስሩ ፍጥረታት መካከል በስውራን ምድብ በሶስተኛ ደረጃ የሚገኘው ሕይወት አንዱ
                ነው፡፡
                በአራተኛው ትዕይንት ይኽ ሕይወት ተገልጦ ስለመጣ በሁለተኛው ትዕይንት ተንጋለው የተገለጡት ጥምረተ ህያዋኖች መጀመሪያ ቀጥ
                አሉ፤ ኋላም እንቁላል ቅርፅ የመሰለው ሰውነታቸው ከላይ ሁለት ክንፍ መስሎ ተገለጠ በመቀጠልም ሁለቱን ክንፎቻችውን ዘርግተው
                በዘጠና አንድ ነገድ ተከፋፍለው ከወዲያ ወዲህ መብረር ቻሉ፡፡<br/>
                በዚህ ቪዲዮ ፍጥረታት ካለመኖር ወደ መኖር ካመጣቸው ጋር ትስስር የሚፈጥሩት በሕይወት በኩል መሆኑን በማብራራት ሕይወት
                የሚታየውን በማይታየው ወይም ያማይታየውን በሚታየው አስተሳስሮ መያዙን ያስረዳል፡፡ ከዚህ ወጣ ብሎም በመጽሐፈ አድሜስ ስር
                በአራት ታላላቅ ዘርፍ የቀረቡት መጽሐፍት በአሁን ዘመን የመገለጣቸው ጉዳይ አሁን ላይ የዓለምን የአካሄድ አቅጣጫ የሚዘውረውን
                ሃሳብ በመተካት የዓለምን የሃሳብ መስመር መያዝ መሆኑን ያስረዳል፡፡<br/>
                ጥምረተ ህያዋን ጥምር የሚፈጥሩ ፍጥረታት ናቸው፡፡ ጥምር መፍጠር ማለትም አንድም እርስ በእርሳቸው ተጣምረው አልያም
                ከነገዳቸው ወጥተው ከሌላ ነገድ ጋር ጥምር በመፍጠር ቀድሞ የሌለ ሌላ ፍጥረት ማስገኘት ነው፡፡<br/>
                በዚህ ቪዲዮ የጥምረተ ህያዋን ጥምር የመፍጠር ጉዳይ ላይ ማብራሪያ ተሰጥቶበታል፡፡

                ',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 18,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'አምስተኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '01:36:09',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 10,
                'description' => 'በሰማያተ ዓለም አስር ፍጥረታት ይገኛሉ፡፡ ከእነዚህ አስር ፍጥረታት መካከል በስውራን ምድብ ስር ሃሳብ ይገኛል፡፡ በአምስተኛው
                ትዕይንት ሃሳብ በጥምረት ህያዋን ነገዶች ላይ ተገልጦ መጣ፡፡
                በዚህ ቪዲዮ ሃሳብ አራት ገፅ ያለው ወይም በአራት አቅጣጫ እንደሚቀመጥ ማብራሪያ ቀርቦበታል፡፡
                ',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 19,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ስድስተኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 11,
                'description' => '',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 20,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ሰባተኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 12,
                'description' => '',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 21,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ስምንተኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 13,
                'description' => '',
                'gize_channel_id' => 1,
            ],


            [
                'id' => 22,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'ዘጠነኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 14,
                'description' => '',
                'gize_channel_id' => 1,
            ],


            [
                'id' => 23,
                'parent_id' => 1,
                'collection_type_id' => 6, // Chapter
                'title' => 'አሥረኛው ትዕይንት',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 15,
                'description' => '',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 24,
                'parent_id' => 16, //ጥበብ
                'collection_type_id' => 5, // Introduction
                'title' => '',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 0,
                'series_no' => 1,
                'description' => '',
                'gize_channel_id' => 1,
            ],

            [
                'id' => 25,
                'parent_id' => 16,
                'collection_type_id' => 6, // Chapters
                'title' => 'ትዕዛዘ ጥበብ',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => '',
                'gize_channel_id' => 1,
            ],


            [
                'id' => 26,
                'parent_id' => null,
                'collection_type_id' => 2, // Book
                'title' => 'ንግርተ ካህዝን',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => 'ይህ መጽሐፍ የሰው ልጅ በምድራዊ ዓለም ላይ ሳለ ከሚገጥመው መከራና ችግር ተዘሎ በታላቅ ክብር ይቀመጥ ዘንድ የሚረዳ የጥበብ ሥርዓት የያዘ መጽሐፍ ነው።',
                'poster_image_url' => 'images/col/Kahzn_1.png',
                'thumb_image_url' => 'images/col/thumb/Kahzn_1.png',
                'slug'=> 'myth-of-kahzn-book-1',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 27,
                'parent_id' => 26,
                'collection_type_id' => 5, // Introduction
                'title' => '',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 0,
                'series_no' => 1,
                'description' => '',
                'gize_channel_id' => 1,
            ],
            [
                'id' => 28,
                'parent_id' => 26, // Kahzn
                'collection_type_id' => 6, // Chapter
                'title' => '',
                'within_days' => 7,
                'for_hours' => 24,
                'duration' => '',
                'unit_value' => 1, //if null get children unit_value sum
                'seriesable' => 1,
                'series_no' => 1,
                'description' => '',
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
