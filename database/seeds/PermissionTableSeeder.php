<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class PermissionTableSeeder extends Seeder
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
       
       $permissions = [
           'user-list',
           'user-create',
           'user-delete',
           'role-list',
           'role-create',
           'role-delete',
           'location-list',
           'location-create',
           'location-delete',
           'projectrole-list',
           'projectrole-create',
           'projectrole-delete',
           'skill-list',
           'skill-create',
           'skill-delete',
           'manager-list',
           'manager-create',
           'manager-delete',
           'workflow-list',
           'workflow-create',
           'workflow-delete',
           'procuringparties-list',
           'procuringparties-create',
           'procuringparties-delete',
           'project_type-list',
           'project_type-create',
           'project_type-delete',
           'sow-list',
           'sow-create',
           'sow-delete',
           'sow-review',
           'sow-approve',
           'sow-download',
           'sow-upload',
           'sow-revision',
           'permission-list',
           'permission-create',
           'permission-delete',
           'sow_master-list',
           'sow_master-create',
           'sow_master-delete',
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }

        // create roles and assign created permissions

        $roles = [
           'super-admin',
           'creator',
           'reviewer',
           'approver'
        ];
        // this can be done as separate statements
        $role = Role::create(['name' => 'creator']);
        $role->givePermissionTo(['sow-list','sow-create', 'sow-delete', 'sow-download','sow-upload']);

        // or may be done by chaining
        $role = Role::create(['name' => 'reviewer'])
            ->givePermissionTo(['sow-list', 'sow-review']);

        $role = Role::create(['name' => 'approver'])
            ->givePermissionTo(['sow-list', 'sow-approve']);    

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $user = User::where('email','admin@test.com')->first();
        $user->assignRole('super-admin');

        //ToDo - remove from production following users role
        
        $user = User::where('email','creator@test.com') -> first();
        $user->assignRole('creator');

        $user = User::where('email','reviewer@test.com') -> first();
        $user->assignRole('reviewer');

        $user = User::where('email','approver@test.com') -> first();
        $user->assignRole('approver');
    }
}
