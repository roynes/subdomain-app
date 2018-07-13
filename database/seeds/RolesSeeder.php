<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();

        foreach (array_get(config('roles'), 'admin') as $role) {
            Role::create([ 'name' => $role, 'label' => $role]);
        }

        foreach (array_get(config('roles'), 'client') as $role) {
            Role::create([ 'name' => $role, 'label' => $role]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
