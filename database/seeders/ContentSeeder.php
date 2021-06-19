<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Pocket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pocket = Pocket::where('title', 'Sports')->get();
        Content::create([
            'url' => 'https://www.espncricinfo.com/',
            'pocket_id' => $pocket[0]->id
        ]);
    }
}
