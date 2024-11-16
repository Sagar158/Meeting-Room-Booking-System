<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
                              ['name' => 'Software Development'],
                              ['name' => 'Quality Assurance (QA)'],
                              ['name' => 'DevOps'],
                              ['name' => 'Information Technology (IT) Support'],
                              ['name' => 'Product Management'],
                              ['name' => 'Project Management'],
                              ['name' => 'UI/UX Design'],
                              ['name' => 'Human Resources (HR)'],
                              ['name' => 'Sales and Marketing'],
                              ['name' => 'Customer Support'],
                              ['name' => 'Data Analytics and Business Intelligence'],
                              ['name' => 'Cybersecurity'],
                              ['name' => 'Finance and Accounting'],
                              ['name' => 'Research and Development (R&D)'],
                              ['name' => 'Infrastructure and Network Management']
                        ];

        foreach($departments as $department)
        {
            Department::create($department);
        }
    }
}
