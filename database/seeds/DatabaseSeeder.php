<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Permission;
use App\Menu;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // seed user
        $user = new User;
        $user->name = 'Administrator';
        $user->username = 'admin';
        $user->email = 'admin@email.com';
        $user->password = Hash::make('admin');
        $user->save();

        // seed role
        $role = new Role;
        $role->name = 'Administrator';
        $role->description = 'Role as Administrator';
        $role->save();
        // attach role to user
        $user->attachRole($role);

        // seed Menu
        $menu = new Menu;
        $menu->name = 'Beranda';
        $menu->slug = '/';
        $menu->icon = 'fa fa-home';
        $menu->is_active = 1;
        $menu->order_no = 1;
        $menu->save();
        // attach menu to role
        $role->attachMenu($menu);

        // seed Menu
        $menu = new Menu;
        $menu->name = 'Pengaturan';
        $menu->slug = 'settings';
        $menu->icon = 'fa fa-cog';
        $menu->is_active = 1;
        $menu->order_no = 9;
        $menu->save();
        // attach menu to role
        $role->attachMenu($menu);

        // seed Menu
        $menu = new Menu;
        $menu->name = 'Menu';
        $menu->slug = 'menus';
        $menu->icon = 'fa fa-list-alt';
        $menu->parent = 'settings';
        $menu->is_active = 1;
        $menu->order_no = 1;
        $menu->save();
        // attach menu to role
        $role->attachMenu($menu);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'menu_index';
        $perm->description = 'Index Menu';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'menu_create';
        $perm->description = 'Create Menu';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'menu_update';
        $perm->description = 'Update Menu';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'menu_delete';
        $perm->description = 'Delete Menu';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);

        // seed Menu
        $menu = new Menu;
        $menu->name = 'Roles';
        $menu->slug = 'roles';
        $menu->icon = 'fa fa-users';
        $menu->parent = 'settings';
        $menu->is_active = 1;
        $menu->order_no = 2;
        $menu->save();
        // attach menu to role
        $role->attachMenu($menu);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'role_index';
        $perm->description = 'Index Role';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'role_create';
        $perm->description = 'Create Role';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'role_update';
        $perm->description = 'Update Role';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'role_delete';
        $perm->description = 'Delete Role';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);

        // seed Menu
        $menu = new Menu;
        $menu->name = 'Users';
        $menu->slug = 'users';
        $menu->icon = 'fa fa-user';
        $menu->parent = 'settings';
        $menu->is_active = 1;
        $menu->order_no = 3;
        $menu->save();
        // attach menu to role
        $role->attachMenu($menu);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'user_index';
        $perm->description = 'Index User';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'user_create';
        $perm->description = 'Create User';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'user_update';
        $perm->description = 'Update User';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);
        // seed Permission
        $perm = new Permission;
        $perm->name = 'user_delete';
        $perm->description = 'Delete User';
        $perm->save();
        // attach to menu
        $menu->attachPermission($perm);
        // attach to role
        $role->attachPermission($perm);

    }
}
