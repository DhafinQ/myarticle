<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'user_menu',
                'guard_name' => 'web',
                'slug' => 'CRUD User'
            ],
            [
                'name' => 'user_create',
                'slug' => 'CRUD User'
            ],
            [
                'name' => 'user_read',
                'guard_name' => 'web',
                'slug' => 'CRUD User'
            ],
            [
                'name' => 'user_update',
                'guard_name' => 'web',
                'slug' => 'CRUD User'
            ],
            [
                'name' => 'user_delete',
                'guard_name' => 'web',
                'slug' => 'CRUD User'
            ],
            [
                'name' => 'permission_menu',
                'guard_name' => 'web',
                'slug' => 'CRUD Permission'
            ],
            [
                'name' => 'permission_create',
                'guard_name' => 'web',
                'slug' => 'CRUD Permission'
            ],
            [
                'name' => 'permission_read',
                'guard_name' => 'web',
                'slug' => 'CRUD Permission'
            ],
            [
                'name' => 'permission_update',
                'guard_name' => 'web',
                'slug' => 'CRUD Permission'
            ],
            [
                'name' => 'permission_delete',
                'guard_name' => 'web',
                'slug' => 'CRUD Permission'
            ],
            [
                'name' => 'role_menu',
                'guard_name' => 'web',
                'slug' => 'CRUD Role'
            ],
            [
                'name' => 'role_create',
                'guard_name' => 'web',
                'slug' => 'CRUD Role'
            ],
            [
                'name' => 'role_read',
                'guard_name' => 'web',
                'slug' => 'CRUD Role'
            ],
            [
                'name' => 'role_update',
                'guard_name' => 'web',
                'slug' => 'CRUD Role'
            ],
            [
                'name' => 'role_delete',
                'guard_name' => 'web',
                'slug' => 'CRUD Role'
            ],
            [
                'name' => 'category_menu',
                'guard_name' => 'web',
                'slug' => 'CRUD Category'
            ],
            [
                'name' => 'category_create',
                'guard_name' => 'web',
                'slug' => 'CRUD Category'
            ],
            [
                'name' => 'category_read',
                'guard_name' => 'web',
                'slug' => 'CRUD Category'
            ],
            [
                'name' => 'category_update',
                'guard_name' => 'web',
                'slug' => 'CRUD Category'
            ],
            [
                'name' => 'category_delete',
                'guard_name' => 'web',
                'slug' => 'CRUD Category'
            ],
            [
                'name' => 'article_menu',
                'guard_name' => 'web',
                'slug' => 'CRUD Article'
            ],
            [
                'name' => 'article_create',
                'guard_name' => 'web',
                'slug' => 'CRUD Article'
            ],
            [
                'name' => 'article_read',
                'guard_name' => 'web',
                'slug' => 'CRUD Article'
            ],
            [
                'name' => 'article_update',
                'guard_name' => 'web',
                'slug' => 'CRUD Article'
            ],
            [
                'name' => 'article_delete',
                'guard_name' => 'web',
                'slug' => 'CRUD Article'
            ],
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }
}
