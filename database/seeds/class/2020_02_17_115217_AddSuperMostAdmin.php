<?php

use Illuminate\Database\Seeder;

class AddSuperMostAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            $data = [
                'name' => 'Supper most admin',
                'email' => 'vallabh.kansagara@commercepundit.com',
                'updated_by' => 1,
                'created_by' => 1,
                'password' => \Illuminate\Support\Facades\Hash::make('vallabh.kansagara@commercepundit.com'),
            ];

            $user = \App\Entities\User::create($data);

            $allRoles = \App\Entities\Role::all()->pluck('name')->toArray();
            $user->assignRole($allRoles);
//        event( new RegisterEvent($user));
            \Illuminate\Support\Facades\DB::commit();
        } catch (Exception $exception) {
            \Illuminate\Support\Facades\DB::rollBack();
            dd($exception->getMessage());
        }
    }
}
