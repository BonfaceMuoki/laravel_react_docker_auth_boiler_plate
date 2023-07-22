<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = array(
         );
          //admin 
         $role=Role::where('slug','super admin')->first();
          //admin role
        foreach ($permissions as $permission) {

            $createdpermission=Permission::create([
                'name' => $permission['name'],
                'slug' => strtolower( $permission['name'])
            ]);
            $role->permissions()->attach($createdpermission);
            
        }
            //assign admin all permissions
            //assign admin all permissions

        
    }
}
