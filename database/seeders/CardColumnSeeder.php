<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;

class CardColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $cards = Card::all();
        $columns = [1, 2];
        $i = 1;

        foreach ($cards as $card) {

            $card->column()->attach($i);

            $i++;

        }

    }
}
