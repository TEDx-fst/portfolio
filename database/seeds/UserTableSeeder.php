<?php


use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);

        $data = [
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super@admin.com',
            'password' => 'password'
        ];
        $user = Sentinel::registerAndActivate();
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($user);
    }

}
