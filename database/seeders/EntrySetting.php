<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EntrySetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('entry_settings')->insert([
            'entries_limit' => 10,
            'entries_report_num' => 2,
        ]);

    }
}
