<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
{
    // 先にカテゴリを作成
    $this->call(CategorySeeder::class);

    // その後にコンタクトを作成
    \App\Models\Contact::factory(35)->create();
}


}
