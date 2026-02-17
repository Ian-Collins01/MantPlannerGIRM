<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AreaSeeder::class);
        $this->call(MachineSeeder::class);
        $this->call(MaintenanceTypeSeeder::class);
        $this->call(TaskHeaderSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(DepartmentSeeder::class);

        User::factory()->createMany([
            [
                'employee_number' => '123',
                'department_id' => Department::where('description','Mantenimiento')->value('id'),
                'name' => 'Test User',
                'email' => 'test@email.com',
                'password' => '123123123',
                'user_type_id' => UserType::where('name','SuperAdmin')->value('id'),
            ],
        ]);
    }
}
