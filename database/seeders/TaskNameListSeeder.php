<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskNameListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            "Twitter",
            "Facebook",
            "Medium",
            "Instagram",
            "Reddit",
            "Discord",
            "Telegram"
        ];

        for ($i=0; $i < count($list); $i++) { 
            DB::table('task_name_list')->insert([
                'name' => $list[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
