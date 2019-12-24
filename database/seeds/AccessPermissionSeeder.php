<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\User;

class AccessPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=user::where('id',1)->first();
        $adminrole=role::where('name','superadmin')->first();
        $user->assignRole($adminrole);
        $roles=role::get();
        foreach($roles as $role){
            if($role->name=='superadmin'){
                $permissions=Permission::get();
                foreach($permissions as $permission){
                $role->givePermissionTo($permission);
            }
            }
            if($role->name=='tech'){
                $permission=Permission::where('name','ticket edit')->first();
                $role->givePermissionTo($permission);
            }
            if($role->name=='sales'){
                $permission=Permission::where('name','ticket create')->first();
                $role->givePermissionTo($permission);
            }
            if($role->name=='customer'){
                $permission=Permission::where('name','ticket edit')->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
