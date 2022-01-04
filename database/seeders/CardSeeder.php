<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;


class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::insert([
            [
                'task' => 'Agregar subtareas al kanban',
                'date' => \Carbon\Carbon::now(),
                'user_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'task' => 'Testing kanban',
                'date' => \Carbon\Carbon::now(),
                'user_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
