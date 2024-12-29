<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($x=0; $x <= 40; $x++) {
            DB::table('quiz')->insert([
                'question' => 'In the field of astronomy, which planet in our solar system is commonly referred to as the \'Red Planet\' due to its reddish appearance caused by iron oxide on its surface?',
                'a_answer' => 'Venus',
                'b_answer' => 'Mars',
                'c_answer' => 'Jupiter',
                'd_answer' => 'Neptune',
                'correct_answer' => rand(1, 4),
                'question_order' => rand(1, 100),
                'course_id' => rand(1, 56),
            ]);
            DB::table('quiz')->insert([
                'question' => 'In world history, what city is famously known as the birthplace of the Renaissance, a cultural movement that profoundly influenced art, architecture, and literature in Europe during the 14th to 17th centuries?',
                'a_answer' => 'Florence',
                'b_answer' => 'Rome',
                'c_answer' => 'Paris',
                'd_answer' => 'Athens',
                'correct_answer' => rand(1, 4),
                'question_order' => rand(1, 100),
                'course_id' => rand(1, 56),
            ]);
            DB::table('quiz')->insert([
                'question' => 'In computer programming, what is the term used to describe a high-level language commonly utilized for designing the structure and presentation of web pages in combination with JavaScript and CSS?',
                'a_answer' => 'C++',
                'b_answer' => 'HTML ',
                'c_answer' => 'Python',
                'd_answer' => 'Ruby',
                'correct_answer' => rand(1, 4),
                'question_order' => rand(1, 100),
                'course_id' => rand(1, 56),
            ]);
            DB::table('quiz')->insert([
                'question' => 'In biology, what process involves the division of a single parent cell into two genetically identical daughter cells, which is crucial for growth, repair, and asexual reproduction in living organisms?',
                'a_answer' => 'Meiosis',
                'b_answer' => 'Mitosis',
                'c_answer' => 'Photosynthesis',
                'd_answer' => 'Respiration',
                'correct_answer' => rand(1, 4),
                'question_order' => rand(1, 100),
                'course_id' => rand(1, 56),
            ]);
            DB::table('quiz')->insert([
                'question' => 'In literature, which classic novel written by George Orwell explores the themes of totalitarianism, surveillance, and individual freedom through the experiences of its protagonist, Winston Smith, in a dystopian society?',
                'a_answer' => '"Animal Farm"',
                'b_answer' => '"1984"',
                'c_answer' => '"Brave New World"',
                'd_answer' => '"Fahrenheit 451"',
                'correct_answer' => rand(1, 4),
                'question_order' => rand(1, 100),
                'course_id' => rand(1, 56),
            ]);
        }
    }
}
