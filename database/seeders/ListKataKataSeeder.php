<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListKataKataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            "A great & excellent project. Thank you for sharing this wonderful opportunity. Best wishes to all team members. Keep going to the moon ✈🔥",
            "Best project ever, I am very happy to be participating in this project. I hope this project will gain more popularity in the future",
            "The project is implemented professionally and has a clear development plan. Made by a very professional and experienced team",
            "This is definitely going to be HUGE! as the teams has been an inspiration in their innovative approaches towards achieving the project goals and visions, I am so glad to be part of this",
            "This project is looks so innovative and impactful, happy to take participate in such huge project. You guys are very hard working and I am pretty sure you will reach to the Moon very soon",
            "Awesome project with great potential & with the team's dedication & ingenuity and excellent community support, It could shoot straight to the top and on the moon"
        ];
 
        for ($i=0; $i < count($list); $i++) { 
            DB::table('list_kata_kata')->insert([
                'judul' => 'Templet '.($i+1),
                'message' => $list[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
