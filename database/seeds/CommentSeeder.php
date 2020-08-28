<?php

use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        $role_user = Role::whereType('USER')->first();

        $counter = 1;
        foreach(Product::get()->take(5) as $product) {
            for ($i=$counter; $i > 0 ; $i--) {
                $user = User::where('role_id',$role_user->id)->get()->random(1)->first();
                factory(\App\Models\Comment::class)->create(['user_id'=>$user->id,'product_id'=>$product->id]);
            }
            $counter++;
        }
    }
}
