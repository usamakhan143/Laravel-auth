<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Creating User Posttype Permissions
        DB::table('permissions')->insert([

            'name' => 'User-create',
            'for' => 'users_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'User-update',
            'for' => 'users_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'User-destroy',
            'for' => 'users_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'User-index',
            'for' => 'users_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);


        // Creating Roles Posttype Permissions
        DB::table('permissions')->insert([

            'name' => 'Role-create',
            'for' => 'roles_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'Role-update',
            'for' => 'roles_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'Role-destroy',
            'for' => 'roles_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'Role-index',
            'for' => 'roles_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);


        // Creating Permission Posttype Permissions
        DB::table('permissions')->insert([

            'name' => 'Permission-index',
            'for' => 'permissions_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'Permission-create',
            'for' => 'permissions_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'Permission-update',
            'for' => 'permissions_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);

        DB::table('permissions')->insert([

            'name' => 'Permission-destroy',
            'for' => 'permissions_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);


        // Change Password Permission
        DB::table('permissions')->insert([

            'name' => 'Change-password',
            'for' => 'other_post-type',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);


        // Creating Role
        DB::table('roles')->insert([

            'name' => 'Developer',
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);
        for($i=1; $i<=13; $i++) {
            
            DB::table('permission_roles')->insert([

                'permission_id' => $i,
                'role_id' => 1

            ]);

        }

        // Creating Account
        DB::table('accounts')->insert([

            'name' => 'Usama',
            'email' => 'usamaoff796@gmail.com',
            'password' => bcrypt(123456789),
            'image' => 'backend/images/usama.png',
            'phone' => '03062715650',
            'status' => 1,
            'created_at' => '2022-09-27 16:22:00',
            'updated_at' => '2022-09-27 16:22:00'

        ]);
        DB::table('account_roles')->insert([

            'account_id' => 1,
            'role_id' => 1

        ]);
    }
}
