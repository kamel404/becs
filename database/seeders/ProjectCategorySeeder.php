<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;

class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Residential Construction', 'slug' => 'residential'],
            ['name' => 'Commercial Construction',  'slug' => 'commercial'],
            ['name' => 'Industrial Construction',  'slug' => 'industrial'],
        ];

        foreach ($categories as $cat) {
            ProjectCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
