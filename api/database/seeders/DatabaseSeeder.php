<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Genre;
use App\Models\Party;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 下記コードだとpartyテーブルのonser_idに必要なidが入らないため、今回は手動で変更
        Party::factory(3)
            ->has(User::factory()->count(8))
            ->create();
    }
}
