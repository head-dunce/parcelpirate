<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['Admin', 'Freight Forwarder', 'Customer'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
