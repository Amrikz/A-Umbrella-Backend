<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();

        $role->name = 'Пользователь';
        $role->slug = 'user';
        $role->replicate()->save();

        $role->name = 'Модератор';
        $role->slug = 'moderator';
        $role->replicate()->save();

        $role->name = 'Администратор';
        $role->slug = 'admin';
        $role->replicate()->save();
    }
}
