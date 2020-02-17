<?php

use Illuminate\Database\Seeder;

class AddPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $roles = [
                'super-most-admin',
                'admin',
                'guest',
            ];

            $rolesData = [];
            foreach ($roles as $role) {
                $data = [
                    'name' => sprintf("%s", strtolower($role)),
                    'guard_name' => 'web',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ];
                $rolesData [] = $data;
            }

            \App\Entities\Role::insert($rolesData);

            $modules = [
                'Dashbord',
                'User',
                'Role',
                'Permission',
            ];
            $permissions = [
                'Add',
                'Edit',
                'View',
                'Update',
                'List',
                'Active',
                'Inactive',
            ];

            $fullPermissionNames = [];
            foreach ($modules as $module) {
                foreach ($permissions as $permission) {
                    $data = [
                        'name' => sprintf("%s_%s", strtolower($permission), strtolower($module)),
                        'guard_name' => 'web',
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ];
                    $fullPermissionNames [] = $data;
                }
            }
            \App\Entities\Permission::insert($fullPermissionNames);

        } catch (Exception $exception) {

        }
    }
}
