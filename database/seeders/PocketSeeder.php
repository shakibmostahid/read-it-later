<?php

namespace Database\Seeders;

use App\Models\Pocket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PocketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pocket::create([
            'title' => 'Sports'
        ]);
        Pocket::create([
            'title' => 'Video Games'
        ]);
    }
}
