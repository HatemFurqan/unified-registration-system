<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'عرض-الادوار',
            'اضافة-الادوار',
            'تعديل-الادوار',
            'حذف-الادوار',
            'عرض-المسؤولين',
            'اضافة-المسؤولين',
            'تعديل-المسؤولين',
            'حذف-المسؤولين',
            'عرض-الكوبونات',
            'اضافة-الكوبونات',
            'تعديل-الكوبونات',
            'حذف-الكوبونات',
            'عرض-الاشتراكات',
            'تعديل-حالة-الدفع',
            'إرسال-إلى-جوجل-شيت',
            'استيراد-البيانات',
            'تصدير-البيانات',
        ];

        $createdAt = Carbon::parse('2022-02-23 13:58:23');
        $updatedAt = Carbon::parse('2022-02-23 13:58:23');

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission, 'guard_name' => 'admin'],
                ['created_at' => $createdAt, 'updated_at' => $updatedAt]
            );
        }

        $this->command->info('Permissions created successfully!');

        // Create Roles
        $superAdminRole = Role::updateOrCreate(
            ['name' => 'Super Admin', 'guard_name' => 'admin'],
            ['created_at' => $createdAt, 'updated_at' => $updatedAt]
        );

        $editorRole = Role::updateOrCreate(
            ['name' => 'محرر', 'guard_name' => 'admin'],
            ['created_at' => Carbon::parse('2022-02-24 09:09:26'), 'updated_at' => Carbon::parse('2022-02-24 09:09:26')]
        );

        $reviewerRole = Role::updateOrCreate(
            ['name' => 'مراجع بيانات', 'guard_name' => 'admin'],
            ['created_at' => Carbon::parse('2022-02-24 09:16:21'), 'updated_at' => Carbon::parse('2022-02-24 09:16:21')]
        );

        $this->command->info('Roles created successfully!');

        // Assign all permissions to Super Admin
        $allPermissions = Permission::where('guard_name', 'admin')->pluck('id')->all();
        $superAdminRole->syncPermissions($allPermissions);

        // Assign specific permissions to Editor (محرر)
        $editorPermissions = [1, 3, 5, 7, 9, 11]; // عرض, تعديل (no add, delete)
        $editorRole->syncPermissions($editorPermissions);

        // Assign specific permissions to Reviewer (مراجع بيانات)
        $reviewerPermissions = [1, 3, 5, 7, 9, 11]; // عرض, تعديل (no add, delete)
        $reviewerRole->syncPermissions($reviewerPermissions);

        $this->command->info('Permissions assigned to roles successfully!');

        // Assign Super Admin role to Admin with ID 1
        $admin = Admin::find(1);
        if ($admin) {
            $admin->assignRole($superAdminRole);
            $this->command->info('Super Admin role assigned to Admin ID 1 successfully!');
        } else {
            $this->command->warn('Admin with ID 1 not found. Please create admin first or run AdminSeeder.');
        }
    }
}
