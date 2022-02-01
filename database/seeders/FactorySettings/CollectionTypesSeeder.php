<?php

namespace Database\Seeders\FactorySettings;

use App\Models\Collection;
use App\Models\CollectionType;
use Illuminate\Database\Seeder;

class CollectionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $collection_types = [
            [
                'id' => 1,
                'parent_id'=> null,
                'plural_name' => 'ሲዝኖች',
                'plural_name_en' => 'Seasons',
                'singular_name' => 'ሲዝን',
                'singular_name_en' => 'Season',
                'description' => 'description',
            ],
            [
                'id' => 2,
                'parent_id'=> null,
                'plural_name' => 'መጽሐፍት',
                'plural_name_en' => 'Books',
                'singular_name' => 'መጽሐፍ',
                'singular_name_en' => 'Book',
                'description' => 'description',
            ],
            [
                'id' => 3,
                'parent_id'=> 1,
                'plural_name' => 'ክፍሎች',
                'plural_name_en' => 'Episoids',
                'singular_name' => 'ክፍል',
                'singular_name_en' => 'Episoid',
                'description' => 'description',
            ],
            [
                'id' => 4,
                'parent_id'=> 2,
                'plural_name' => 'መቅድም',
                'plural_name_en' => 'Preface',
                'singular_name' => 'መቅድም',
                'singular_name_en' => 'Prefaces',
                'description' => 'description',
            ],
            [
                'id' => 5,
                'parent_id'=> 2,
                'plural_name' => 'መግቢያ',
                'plural_name_en' => 'Introduction',
                'singular_name' => 'መግቢያ',
                'singular_name_en' => 'Introduction',
                'description' => 'description',
            ],
            [
                'id' => 6,
                'parent_id'=> 2,
                'plural_name' => 'ምዕራፎች',
                'plural_name_en' => 'Chapters',
                'singular_name' => 'ምዕራፍ',
                'singular_name_en' => 'Chapter',
                'description' => 'description',
            ],
        ];

        foreach ($collection_types as $type) {
            CollectionType::create($type);
        }

        // CollectionType::insert($collection_types);



        // $collection = Collection::find(1);
        // $collection->channelvideos()->sync([1, 2]);

    }
}
