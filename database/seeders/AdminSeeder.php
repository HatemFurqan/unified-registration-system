<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if admin already exists
        $existingAdmin = Admin::where('email', 'admin@a.a')->first();
        
        if (!$existingAdmin) {
            $admin = Admin::create([
                'name' => 'شؤون الطلاب',
                'email' => 'admin@a.a',
                'password' => Hash::make('12345'),
                'email_verified_at' => now(),
            ]);
            
            // Assign Super Admin role if it exists
            $superAdminRole = Role::where('name', 'Super Admin')->where('guard_name', 'admin')->first();
            if ($superAdminRole) {
                $admin->assignRole($superAdminRole);
                $this->command->info('Super Admin role assigned to admin!');
            }
            
            $this->command->info('Admin created successfully!');
            $this->command->info('Email: admin@a.a');
            $this->command->info('Password: 12345');
        } else {
            // Update existing admin
            $existingAdmin->update([
                'name' => 'شؤون الطلاب',
                'password' => Hash::make('12345'),
            ]);
            
            // Ensure Super Admin role is assigned
            $superAdminRole = Role::where('name', 'Super Admin')->where('guard_name', 'admin')->first();
            if ($superAdminRole && !$existingAdmin->hasRole($superAdminRole)) {
                $existingAdmin->assignRole($superAdminRole);
                $this->command->info('Super Admin role assigned to admin!');
            }
            
            $this->command->info('Admin updated successfully!');
        }
    }
}
