<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $permissions = [
            'Administer roles & permissions',
           'user list',
           'user create',
           'user edit',
           'user delete',
           'ticket list',
           'ticket create',
           'ticket edit',
           'ticket delete'
        ];


        foreach ($permissions as $permission) {
             permission::create(['name' => $permission]);
        }
    }
}
