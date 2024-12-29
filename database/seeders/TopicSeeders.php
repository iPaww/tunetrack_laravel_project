<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TopicSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($x=0; $x <= 150; $x++) {
            DB::table('topics')->insert([
                'title' => 'Topic ' . Str::random(10),
                'description' => 'The transition to renewable energy has become one of the most pressing global challenges in recent decades, primarily driven by the need to combat climate change. This shift from fossil fuels to renewable sources like solar, wind, hydroelectric, and geothermal energy is seen as a crucial step in reducing carbon emissions, lowering the impact of global warming, and ensuring a sustainable future for the planet.
Historically, human civilization has relied heavily on fossil fuels like coal, oil,' . Str::random(50) . ' and natural gas to power industries, transportation, and electricity generation. However, the negative environmental effects of these energy sources, such as air pollution, habitat destruction, and greenhouse gas emissions, have become increasingly evident, pushing for urgent reforms. In response, nations around the world have been investing in renewable energy technologies that not only help curb the negative impact of climate change but also promise to meet growing energy demands in a more sustainable and efficient way.
Solar power has emerged as one of the most popular renewable energy sources, thanks to its abundance and decreasing cost of production. Technological advancements in photovoltaic cells have made solar panels more efficient and affordable, opening up opportunities for both residential and industrial use. Wind energy, another major player in the renewable sector, has seen exponential growth, particularly in regions like Europe and the United States, where wind farms are becoming a common sight. Wind turbines, both onshore and offshore, are capable of generating vast amounts of electricity with minimal environmental impact, and they have a significant role to play in reducing dependence on fossil fuels.',
                'course_id' => rand(1, 56),
                'sub_category_id' => rand(1, 49)
            ]);
        }
    }
}
