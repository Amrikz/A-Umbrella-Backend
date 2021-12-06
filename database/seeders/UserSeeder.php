<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moderator_role = Role::where('slug', 'moderator')->first();
        $admin_role = Role::where('slug', 'admin')->first();

        $user = User::factory()->make([
            'first_name'    => 'Николай',
            'last_name'     => 'Николаевич',
            'login'         => 'amrikz',
            'role_id'       => $admin_role->id,
        ]);
        $user->save();

        $user = User::factory()->make([
            'login'         => 'moderator',
            'role_id'       => $moderator_role->id,
        ]);
        $user->save();

        $user = User::factory()->make([
            'login'         => 'user',
        ]);
        $user->save();
    }
}
