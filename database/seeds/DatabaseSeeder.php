<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([UsersTableSeeder::class]);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);

        $this->call(PaymentSeeder::class);

        $this->call(OrderSeeder::class);
        $this->call(OrderProductSeeder::class);
        $this->call(SupplyHistoryProductSeeder::class);

        $this->call(InvoiceSeeder::class);




    }
}
