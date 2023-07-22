<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use DB;
class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $superadmin_role = Role::where('slug', 'super admin')->first();
        $admin_permissions = array(
              );
        
          foreach ($admin_permissions as $permission) {
            $perm = Permission::where("name", $permission['name'])->first();
            $axist=DB::table("roles_permissions")->where("permission_id",$perm->id)->where("role_id",$superadmin_role->id)->get();
            if(sizeof($axist)==0){
                
                $superadmin_role->permissions()->attach($perm);
             }
            
        }
    }
}
