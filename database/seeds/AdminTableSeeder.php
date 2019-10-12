<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $CreatedUser = factory(User::class, 1)->create();

        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);

        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($CreatedUser);

        $user = Sentinel::findById(1);
        $activation = Activation::create($user);
        Activation::complete($user, "$activation->code");
    }

}
