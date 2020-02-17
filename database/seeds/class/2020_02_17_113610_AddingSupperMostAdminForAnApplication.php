<?php

use Illuminate\Database\Seeder;

class AddingSupperMostAdminForAnApplication extends Seeder
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

            \App\Entities\User::create($data);
//        event( new RegisterEvent($user));
            \Illuminate\Support\Facades\DB::commit();
        } catch (Exception $exception) {
            \Illuminate\Support\Facades\DB::rollBack();
            dd($exception->getMessage());
        }
    }
}
