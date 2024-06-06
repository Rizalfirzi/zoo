<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        // BUAT ROLE
        $superadmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);


        // BUAT PERMISSION
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $data = [
            [
                'name' => 'create',
            ],
            [
                'name' => 'read',
            ],
            [
                'name' => 'update',
            ],
            [
                'name' => 'delete',
            ],
        ];

        foreach ($data as $item) {
            DB::table('hakakses')->insert($item);
        }

        $permissi = [
            [
                'name' => 'Dashboard',
                'description' => 'dashboard',
                'icon' => 'ri-dashboard-2-line',
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 1,
                'position' => 1,
                'route' => 'dashboard',
                'group' => 1
            ],
            [
                'name' => 'Settings',
                'description' => 'settings',
                'icon' => 'ri-settings-2-line',
                'guard_name' => 'web',
                'type' => 'dropdown',
                'level' => 1,
                'position' => 100,
                'route' => 'settings',
                'group' => 20
            ],
            [
                'name' => 'User Management',
                'description' => 'User Management',
                'icon' => 'ri-file-user-line',
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 2,
                'position' => 1,
                'route' => 'settings.user',
                'group' => 20
            ],
            [
                'name' => 'Role Management',
                'description' => 'Role Management',
                'icon' => 'ri-shield-user-line',
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 2,
                'position' => 2,
                'route' => 'settings.role',
                'group' => 20
            ],
            [
                'name' => 'Menu Management',
                'description' => 'Menu Management',
                'icon' => 'ri-shield-star-line',
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 2,
                'position' => 3,
                'route' => 'settings.permission',
                'group' => 20
            ],

        ];

        // ASSIGN ROLE TO PERMISSION

        $permission = DB::table('permissions')->insert($permissi);
        $permissions = Permission::all();
        $hakaksesIds = DB::table('hakakses')->pluck('id');
        foreach ($permissions as $permission) {
            $superadmin->givePermissionTo($permission->name);

            foreach ($hakaksesIds as $hakaksesId) {
                DB::table('hakakses_permission')->insert([
                    'permission_id' => $permission->id,
                    'hakakses_id' => $hakaksesId,
                    'role_id' => $superadmin->id,
                ]);
            }
        }

        $permisi_admin = [
            'Dashboard',
        ];
        $permissions_admin = Permission::whereNotIn('name', $permisi_admin)->get();
        foreach ($permissions_admin as $permission_admin) {
            $admin->givePermissionTo($permission_admin->name);

            foreach ($hakaksesIds as $hakaksesId) {
                DB::table('hakakses_permission')->insert([
                    'permission_id' => $permission_admin->id,
                    'hakakses_id' => $hakaksesId,
                    'role_id' => $admin->id,
                ]);
            }
        }

        
        $superadminUser = User::firstWhere('email', 'superadmin@gmail.com');
        $adminUser = User::firstWhere('email', 'admin@gmail.com');

        $superadminUser->syncRoles([$superadmin->id]);
        $adminUser->syncRoles([$admin->id]);
    }
}
