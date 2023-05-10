<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => '纸皮类',
                'icon' => 'icon-iconzhipilei'
            ],
            [
                'name' => '金属类',
                'icon' => 'icon-jinshulei'
            ],
            [
                'name' => '塑料类',
                'icon' => 'icon-suliaolei'
            ],
            [
                'name' => '家电类',
                'icon' => 'icon-jiadian'
            ],
            [
                'name' => '其他废品',
                'icon' => 'icon-faxianyiwu'
            ],
        ];

        foreach ($categories as $key => $category) {
            $this->createDb($category);
        }
        // DB::table('categories')->insert($categories);
    }

    public function createDb($data){
        Categories::create($data);
    }
}
