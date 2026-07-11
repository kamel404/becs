<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'             => 'BIM-Driven Construction',
                'slug'              => 'bim-driven-construction',
                'short_description' => 'Delivering Building Information Modeling insights for superior design accuracy, cost control, and seamless on-site implementation using advanced 3D coordination.',
                'description'       => '<p>We place Building Information Modeling at the heart of our construction strategy. By using high-fidelity 3D modeling, we identify structural conflicts before site execution, evaluate precise material volumes, and coordinate electrical, mechanical, and architectural layouts to minimize errors and save project budget.</p>',
                'icon'              => 'fas fa-cubes',
                'image'             => null,
                'order'             => 1,
            ],
            [
                'title'             => 'Geographic Information Systems',
                'slug'              => 'geographic-information-systems',
                'short_description' => 'Advanced GIS spatial data analysis for infrastructure planning, land use studies, and environmental assessments — transforming complex data into actionable intelligence.',
                'description'       => '<p>We leverage spatial datasets to support large-scale infrastructure planning and land use studies. Our GIS specialists analyze topographic data, map utilities distribution, conduct flood risk assessments, and model environmental metrics to supply municipal councils and private developers with intelligent spatial reports.</p>',
                'icon'              => 'fas fa-map-marked-alt',
                'image'             => null,
                'order'             => 2,
            ],
            [
                'title'             => 'Construction Finishes',
                'slug'              => 'construction-finishes',
                'short_description' => 'Premium interior and exterior finishing works executed with meticulous attention to detail. From luxury residential to large-scale commercial projects.',
                'description'       => '<p>Our finishing contracting department delivers premium interior and exterior architecture finishing. We focus on detail and material quality to complete luxury residential villas, offices, and commercial storefronts. Our services cover plastering, marble tiling, custom wood features, waterproofing layers, and thermal insulation.</p>',
                'icon'              => 'fas fa-paint-roller',
                'image'             => null,
                'order'             => 3,
            ],
            [
                'title'             => 'Structural Engineering',
                'slug'              => 'structural-engineering',
                'short_description' => 'Rigorous structural design services guaranteeing safety, durability, and cost-efficiency across all project scales.',
                'description'       => '<p>We deliver rigorous structural design services to guarantee structural safety, durability, and cost-efficiency. Our structural engineers perform dynamic loading calculations, seismic analysis, foundation assessments, and steel/concrete modeling using modern structural calculation codes.</p>',
                'icon'              => 'fas fa-drafting-compass',
                'image'             => null,
                'order'             => 4,
            ],
            [
                'title'             => 'Project Management',
                'slug'              => 'project-management',
                'short_description' => 'Complete site supervision and project coordination ensuring on-time, on-budget delivery with uncompromising quality standards.',
                'description'       => '<p>BECS offers complete site supervision and project coordination. We coordinate site engineers, handle subcontractor agreements, execute risk assessments, run quality assurance audits, and maintain project scheduling to ensure on-time delivery within the defined budget.</p>',
                'icon'              => 'fas fa-hard-hat',
                'image'             => null,
                'order'             => 5,
            ],
            [
                'title'             => 'Survey & Site Planning',
                'slug'              => 'survey-site-planning',
                'short_description' => 'Professional topographic land surveys and boundary mapping using modern GPS and Total Station technology.',
                'description'       => '<p>We conduct professional topographic land surveys and boundary mapping services. Using modern GPS technology and high-precision Total Stations, we deliver spatial survey drawings essential for preliminary design, boundary verification, municipal zoning permits, and civil excavation planning.</p>',
                'icon'              => 'fas fa-ruler-combined',
                'image'             => null,
                'order'             => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
