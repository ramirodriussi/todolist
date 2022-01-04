<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Column;


class ColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Column::insert([
            [
                'column' => 'Buffer',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'column' => 'Working',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'column' => 'Done',
                'created_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
