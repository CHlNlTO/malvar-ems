<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'title' => 'Environmental Clearance Form',
                'description' => 'Form required for businesses applying for environmental clearance in the Municipality of Malvar.',
                'file' => null,
                'url' => '#',
                'category' => 'Forms',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Waste Management Guidelines',
                'description' => 'Comprehensive guidelines for proper waste management and segregation for residents and businesses.',
                'file' => null,
                'url' => '#',
                'category' => 'Guidelines',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Sanitary Landfill Operations Manual',
                'description' => 'Detailed manual for the proper operation and maintenance of the municipal sanitary landfill.',
                'file' => null,
                'url' => '#',
                'category' => 'Manuals',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Environmental Code of Malvar',
                'description' => 'The municipal environmental code outlining regulations for environmental protection and conservation.',
                'file' => null,
                'url' => '#',
                'category' => 'Ordinances',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Quarterly Environmental Report Q1 2025',
                'description' => 'First quarter environmental status report for the Municipality of Malvar.',
                'file' => null,
                'url' => '#',
                'category' => 'Reports',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Environmental Compliance Certificate Application Guide',
                'description' => 'Step-by-step guide for applying for an Environmental Compliance Certificate.',
                'file' => null,
                'url' => '#',
                'category' => 'Guidelines',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Waste Collection Schedule 2025',
                'description' => 'Schedule of regular waste collection for all barangays in Malvar.',
                'file' => null,
                'url' => '#',
                'category' => 'Schedules',
                'is_active' => true,
                'order' => 1,
            ],
        ];

        foreach ($documents as $document) {
            Document::create($document);
        }
    }
}
