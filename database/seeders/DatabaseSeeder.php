<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Cashier;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\MiscSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\ProductsSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $roles = Role::all();
        $walkin = User::factory()->create([
            'name' => 'Walk-in Customer',
            'username' => 'walkin',
            'phone' => '09000000000',
            'email' => 'walkin@customer.com',
            'password' => Hash::make('password'),
        ]);
        $walkin->roles()->attach(2);
        Customer::create([
            'user_id' => $walkin->id,
        ]);
        $u = User::factory()->create(['username' => "administrator001"]);
        $u->roles()->attach(1);
        Administrator::create([
            'user_id' => $u->id
        ]);
        for ($i = 1; $i < 4; $i++) {
            $u = User::factory()->create(['username' => "cashier00$i"]);
            $u->roles()->attach(3);
            Cashier::create([
                'user_id' => $u->id
            ]);
        }
        for ($i = 1; $i < 1001; $i++) {
            $u = User::factory()->create(['username' => "customer00$i"]);
            $u->roles()->attach(2);
            Customer::create([
                'user_id' => $u->id
            ]);
        }
        $this->call(MiscSeeder::class);
        $this->call(ProductsSeeder::class);
    }
}
