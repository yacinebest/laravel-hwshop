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
        
        $this->call(PaymentSeeder::class);

        $this->call(OrderSeeder::class);

        $this->call(ProductSeeder::class);

        $this->call(BrandSeeder::class);




        $this->call(SupplyHistorySeeder::class);

        $this->call(InvoiceSeeder::class);
        $this->call(DeliverySeeder::class);

        $this->call(ImageSeeder::class);
    }
}
