<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //read the json file contents
        $jsonData = file_get_contents(public_path('data/courses.json'));
        //convert json object to php associative array
        $dataArray = json_decode($jsonData, true);

        foreach ($dataArray as $value) {
            \App\Course::create($value);
        }
    }
}
