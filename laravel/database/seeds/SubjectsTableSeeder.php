<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全部消す
        DB::table('subjects')->delete();

        $subjects = [
            'PHP',
            'Ruby',
            'JavaScript',
            'HTML',
            'CSS',
            'Python',
            'jQuery',
            'Java',
            'Laravel',
            'Ruby on Rails',
            'Git',
            'SQL',
            'C#',
            'C',
            'C++'
        ];
        
        foreach($subjects as $subject)
        {
            Subject::create([ 'name' => $subject ]);
        }
    }
}
