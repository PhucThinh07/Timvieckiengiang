<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobTypeSeeder extends Seeder{

    /**
     * Run the database seeds.
     */
    public function run()
    : void{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // tắt kiểm tra khóa ngoại

        JobType::truncate();

        $csvFile = fopen(base_path("database/data/job_types.csv"), "r");

        $firstline = TRUE;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE){
            if (!$firstline){
                JobType::create([
                    "name"      => $data['0'],
                    "slug"      => Str::slug($data['0']),
                    "is_active" => $data['1'] === 'TRUE'
                ]);
            }
            $firstline = FALSE;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // khôi phục kiểm tra khóa ngoại

        fclose($csvFile);
    }
}
