<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'slug' => 'All Access'
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'slug' => 'Article Access'
            ],
            [
                'name' => 'Member',
                'guard_name' => 'web',
                'slug' => 'Read Article'
            ],
        ];

        foreach($roles as $role){
            $crole = Role::create($role);
            if($crole->name == "Admin")
            {
                $permissions = [
                    'category_menu',
                    'category_read',
                    'category_update',
                    'category_create',
                    'category_delete',
                    'article_menu',
                    'article_read',
                    'article_update',
                    'article_create',
                    'article_delete',
                ];
                foreach($permissions as $p){
                    $crole->givePermissionTo($p);
                }
            }else if($crole->name == "Member")
            {
                $permissions = [
                    'article_read'
                ];
                foreach($permissions as $p){
                    $crole->givePermissionTo($p);
                }
            }else{
                $permissions = [
                    'user_menu',
                    'user_read',
                    'user_update',
                    'user_create',
                    'user_delete',
                    'permission_menu',
                    'permission_read',
                    'permission_update',
                    'permission_create',
                    'permission_delete',
                    'role_menu',
                    'role_read',
                    'role_update',
                    'role_create',
                    'role_delete',
                    'category_menu',
                    'category_read',
                    'category_update',
                    'category_create',
                    'category_delete',
                    'article_menu',
                    'article_read',
                    'article_update',
                    'article_create',
                    'article_delete',
                ];

                foreach($permissions as $p){
                    $crole->givePermissionTo($p);
                }
            }
        }
    }
}
