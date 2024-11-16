<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['name' => 'Chief Technology Officer (CTO)'],
            ['name' => 'Chief Information Officer (CIO)'],
            ['name' => 'Project Manager'],
            ['name' => 'Product Manager'],
            ['name' => 'Team Lead'],
            ['name' => 'Senior Software Engineer'],
            ['name' => 'Software Engineer'],
            ['name' => 'Junior Software Engineer'],
            ['name' => 'Frontend Developer'],
            ['name' => 'Backend Developer'],
            ['name' => 'Full Stack Developer'],
            ['name' => 'DevOps Engineer'],
            ['name' => 'Quality Assurance (QA) Engineer'],
            ['name' => 'UI/UX Designer'],
            ['name' => 'Business Analyst'],
            ['name' => 'Data Analyst'],
            ['name' => 'Data Scientist'],
            ['name' => 'Database Administrator (DBA)'],
            ['name' => 'Cybersecurity Specialist'],
            ['name' => 'Network Administrator'],
            ['name' => 'IT Support Specialist'],
            ['name' => 'Scrum Master'],
            ['name' => 'Technical Lead'],
            ['name' => 'Solution Architect'],
            ['name' => 'System Administrator'],
            ['name' => 'Mobile App Developer'],
            ['name' => 'Machine Learning Engineer'],
            ['name' => 'Cloud Engineer'],
            ['name' => 'SEO Specialist'],
            ['name' => 'Content Writer'],
            ['name' => 'Digital Marketing Specialist'],
            ['name' => 'Human Resources (HR) Manager'],
            ['name' => 'Finance Manager'],
            ['name' => 'Sales Manager'],
            ['name' => 'Customer Support Representative'],
        ];


        foreach($designations as $designation)
        {
            Designation::create($designation);
        }

    }
}
