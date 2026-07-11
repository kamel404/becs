<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $residential = ProjectCategory::where('slug', 'residential')->first();
        $commercial  = ProjectCategory::where('slug', 'commercial')->first();
        $industrial  = ProjectCategory::where('slug', 'industrial')->first();

        $projects = [
            [
                'project_category_id' => $residential->id,
                'title'               => 'SONGON 914',
                'slug'                => 'songon-914',
                'short_description'   => 'A three-story modern residential development featuring four spacious apartments per floor with dynamic layout plans.',
                'description'         => 'This well-designed three-story building features four spacious apartments per floor, with a total floor area of approximately 600 square meters. The property also offers the potential to add two additional floors, providing ample opportunity for future expansion or customization.',
                'location'            => 'Songon, Abidjan',
                'client'              => 'Confidential',
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749738299666_20250528_091958.jpg',
                'status'              => 'ongoing',
                'is_featured'         => true,
                'images'              => [
                    'https://becs.com.lb/static/images/1749738299664_20250609_104433.jpg',
                    'https://becs.com.lb/static/images/1749738299663_20250609_104436.jpg',
                ],
            ],
            [
                'project_category_id' => $residential->id,
                'title'               => 'SCI CAMILA',
                'slug'                => 'sci-camila',
                'short_description'   => 'Comprehensive renovation of a three-story residential building with remodeling of apartments and rehabilitation of common areas.',
                'description'         => 'This three-story building consists of four apartments per floor, with a total floor area of approximately 600 square meters. The property is undergoing a comprehensive renovation, including the remodeling of existing apartments and the design and completion of two new apartments on each floor.',
                'location'            => 'II Plateau, Abidjan',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749738825925_20250210_103231.jpg',
                'status'              => 'ongoing',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749738825930_20250130_130043.jpg',
                    'https://becs.com.lb/static/images/1749738825923_20250310_125624.jpg',
                ],
            ],
            [
                'project_category_id' => $commercial->id,
                'title'               => 'Citadelle',
                'slug'                => 'citadelle',
                'short_description'   => 'Design and execution of parking area finishes including epoxy flooring, wall rendering, and precise floor marking.',
                'description'         => 'Design and Execution of Parking Area Finishes — Comprehensive design and implementation of parking areas, including epoxy flooring, wall and ceiling rendering, installation of parking accessories, and precise floor marking.',
                'location'            => 'II Plateau, Abidjan',
                'client'              => null,
                'completion_date'     => '2025-05-01',
                'featured_image'      => 'https://becs.com.lb/static/images/1749739283393_20250409_113233.jpg',
                'status'              => 'completed',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749739283377_20250409_113442.jpg',
                    'https://becs.com.lb/static/images/1749739283384_20250409_113339.jpg',
                ],
            ],
            [
                'project_category_id' => $commercial->id,
                'title'               => 'Oceanfront Chalet Development',
                'slug'                => 'oceanfront-chalet-development',
                'short_description'   => 'A premium turnkey hospitality chalet complex featuring guest rooms, pools, and custom architectural layouts.',
                'description'         => 'A turnkey hospitality project featuring six independent guest rooms, a central shared kitchen, landscaped outdoor areas, a swimming pool, and a reception facility. Our scope included full architectural and engineering design, site development, and construction supervision.',
                'location'            => 'Assine, Cote d\'Ivoire',
                'client'              => null,
                'completion_date'     => '2025-05-01',
                'featured_image'      => 'https://becs.com.lb/static/images/1749739383809_20250315_102209.jpg',
                'status'              => 'completed',
                'is_featured'         => true,
                'images'              => [
                    'https://becs.com.lb/static/images/1749739383806_20250319_114843.jpg',
                    'https://becs.com.lb/static/images/1749739383801_20250503_105001.jpg',
                ],
            ],
            [
                'project_category_id' => $residential->id,
                'title'               => 'Private Villa',
                'slug'                => 'private-villa',
                'short_description'   => 'Full rehabilitation of a private residence including interior renovations, landscape redesign, and pool renovation.',
                'description'         => 'Comprehensive rehabilitation of a private residence, including full interior renovations—ceilings, lighting systems, bathrooms, kitchen, and finishes—as well as upgrades to the exterior spaces. The project scope also covered landscape redesign and the renovation of the existing swimming pool.',
                'location'            => 'Cocody, Abidjan',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749744418441_20240427_105434.jpg',
                'status'              => 'completed',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749744418445_20240511_164550.jpg',
                    'https://becs.com.lb/static/images/1749744418447_20240430_155145.jpg',
                ],
            ],
            [
                'project_category_id' => $commercial->id,
                'title'               => 'Private Office',
                'slug'                => 'private-office',
                'short_description'   => 'Bespoke private office space with custom handmade furniture, detailed ceiling design, and high-quality floor finishes.',
                'description'         => 'Design and execution of a bespoke private office space, including complete interior fit-out. The project featured custom handmade furniture, detailed ceiling and lighting design, and high-quality floor finishes. This achievement highlights our expertise in delivering tailored, functional, and aesthetically refined work environments.',
                'location'            => 'Cocody, Abidjan',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749744578043_20240801_160254.jpg',
                'status'              => 'completed',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749744578042_20240801_160300.jpg',
                    'https://becs.com.lb/static/images/1749744578036_20240801_160204.jpg',
                ],
            ],
            [
                'project_category_id' => $industrial->id,
                'title'               => 'Nouvelle Panada Plaste',
                'slug'                => 'nouvelle-panada-plaste',
                'short_description'   => 'Design and construction of a massive two-story industrial warehouse facility with custom administrative offices.',
                'description'         => 'Design and construction of a two-story warehouse, each floor spanning 2,300 sqm, with structural provisions for the future addition of an apartment level. The facility includes designated office areas, combining storage efficiency with administrative functionality.',
                'location'            => 'Koumassi, Abidjan',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749739909746_20241012_101701.jpg',
                'status'              => 'completed',
                'is_featured'         => true,
                'images'              => [
                    'https://becs.com.lb/static/images/1749739909740_20241012_101718.jpg',
                    'https://becs.com.lb/static/images/1749739909750_20240126_114910.jpg',
                ],
            ],
            [
                'project_category_id' => $commercial->id,
                'title'               => 'OMP (O Millimeter Prix)',
                'slug'                => 'omp-o-millimeter-prix',
                'short_description'   => 'Comprehensive renovation of a three-story building into a modern showroom, administrative offices, and storage facilities.',
                'description'         => 'Comprehensive renovation of a three-story building to accommodate a modern showroom, administrative offices, and storage facilities. The scope included the installation of a contemporary façade, advanced lighting and HVAC systems, and complete interior upgrades.',
                'location'            => 'Treichville, Abidjan',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749740101152_20231127_155920.jpg',
                'status'              => 'completed',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749740101157_20231127_155847.jpg',
                    'https://becs.com.lb/static/images/1749740101159_20230711_173848.jpg',
                ],
            ],
            [
                'project_category_id' => $commercial->id,
                'title'               => 'Pâtissière TAYBA',
                'slug'                => 'patissiere-tayba',
                'short_description'   => 'Complete interior design and execution for a functional and aesthetically refined commercial space.',
                'description'         => 'Complete interior design and execution of works for a functional and aesthetically refined space. The scope included concept development, detailed design, material selection, and full implementation—delivering a cohesive and high-quality interior environment tailored to client needs.',
                'location'            => 'Zone 4, Abidjan',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749744849053_20221022_182037.jpg',
                'status'              => 'completed',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749744849059_20221022_182052.jpg',
                    'https://becs.com.lb/static/images/1749744849060_20221022_182117.jpg',
                ],
            ],
            [
                'project_category_id' => $commercial->id,
                'title'               => 'Coumanchi Restaurant',
                'slug'                => 'coumanchi-restaurant',
                'short_description'   => 'Franchise concept adaptation and full execution supervision for a branded restaurant in Abidjan.',
                'description'         => 'Adaptation of a franchisor\'s design concept to local standards and site conditions, with full supervision of execution works. The project ensured brand consistency while meeting regulatory and operational requirements.',
                'location'            => 'Angre, Abidjan',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749740495026_20230612_223035.jpg',
                'status'              => 'completed',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749740495033_20230612_213833.jpg',
                    'https://becs.com.lb/static/images/1749740495037_20230609_192150.jpg',
                ],
            ],
            [
                'project_category_id' => $commercial->id,
                'title'               => 'Il Quattro Chalet',
                'slug'                => 'il-quattro-chalet',
                'short_description'   => 'Design and execution of private chalets with independent swimming pools and comprehensive amenities.',
                'description'         => 'Design and execution of private chalets, each featuring independent swimming pools to ensure maximum privacy and exclusivity. The project includes comprehensive amenities and a dedicated operations area to support seamless management and guest services.',
                'location'            => 'South Lebanon',
                'client'              => null,
                'completion_date'     => null,
                'featured_image'      => 'https://becs.com.lb/static/images/1749740610864_20190628_200158.jpg',
                'status'              => 'completed',
                'is_featured'         => false,
                'images'              => [
                    'https://becs.com.lb/static/images/1749740666907_IMG-20190526-WA0014.jpg',
                    'https://becs.com.lb/static/images/1749740666909_IMG-20190510-WA0054.jpg',
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $images = $projectData['images'] ?? [];
            unset($projectData['images']);

            $project = Project::updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData
            );

            // Seed project images (only if not already seeded)
            if ($project->images()->count() === 0) {
                foreach ($images as $url) {
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'image'      => $url,
                    ]);
                }
            }
        }
    }
}
