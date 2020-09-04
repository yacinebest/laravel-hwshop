<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->delete();
        factory(\App\Models\Payment::class)->create(['contact_info'=>'CCP123456789','phone_number'=>'+213500000000']);

    }
}
