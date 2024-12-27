<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Yamaha FX',
            'price' => 500,
            'description' => '<p>For Sale: High-Quality Acoustic Guitar – Perfect for All Skill Levels'
            .'Looking to sell my acoustic guitar, ideal for beginners and experienced players alike! This guitar features a solid wood body for rich,warm tones,'
            .' making it perfect for a wide range of playing styles, from fingerpicking to strumming. The smooth fretboard ensures '
            .'comfortable playability, and the guitar is easy to tune and maintain. Whether you\'re looking for a reliable practice instrument or a '
            .'guitar for performances, this one offers a beautiful balance of sound and aesthetics.'
            .'<ul>'
            .'<li>Condition: Excellent, gently used</li>'
            .'<li>Brand/Model: [Insert Brand and Model Name]</li>'
            .'<li>Body Material: [e.g., Solid spruce top, mahogany back and sides]</li>'
            .'<li>Fretboard: [e.g., Rosewood]</li>'
            .'<li>Included Accessories: [e.g., Gig bag, tuner, extra strings]</li>'
            .'<li>Price: [Insert Price]</li>'
            .'</ul>'
            .'Feel free to reach out if you have any questions or would like more photos. This guitar has been well cared for and is ready to find a new home!</p>',
            'category_id' => 1,
            'sub_category_id' => 1,
            'product_type_id' => 1,
            'brand_id' => 1,
            'image' => '67557317d4d722.25251400.jpeg',
            'serial_number' =>Str::random(25),
        ]);
        DB::table('products')->insert([
            'name' => 'Trevor James',
            'price' => 500,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.",
            'category_id' => 3,
            'sub_category_id' => 1,
            'product_type_id' => 1,
            'brand_id' => 2,
            'image' => '6755735684e3a3.64016812.webp',
            'serial_number' =>Str::random(25),
        ]);
        DB::table('products')->insert([
            'name' => 'Global',
            'price' => 800,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.",
            'category_id' => 4,
            'sub_category_id' => 4,
            'product_type_id' => 1,
            'brand_id' => 3,
            'image' => '6755737a44a4d4.25204277.jpeg',
            'serial_number' =>Str::random(25),
        ]);
        DB::table('products')->insert([
            'name' => 'Pick',
            'price' => 800,
            'description' => 'Pick for guitars',
            'category_id' => 1,
            'sub_category_id' => 1,
            'product_type_id' => 2,
            'brand_id' => 1,
            'image' => '6755737a44a4d4.25204277.jpeg',
            'serial_number' =>Str::random(25),
        ]);
        // 50 Random Products
        for( $i = 1; $i <= 50; $i++ ) {
            DB::table('products')->insert([
                'name' => 'Instrument Sample ' . $i,
                'price' => rand(100, 50000),
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.",
                'category_id' => rand(1, 6),
                'sub_category_id' => rand(1, 5),
                'product_type_id' => 1,
                'brand_id' => rand(1, 6),
                'image' => '6755737a44a4d4.25204277.jpeg',
                'serial_number' =>Str::random(25),
            ]);
        }

        // 50 Random Supplies
        for( $i = 1; $i <= 50; $i++ ) {
            DB::table('products')->insert([
                'name' => 'Supply Sample ' . $i,
                'price' => rand(100, 50000),
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.",
                'category_id' => rand(1, 6),
                'sub_category_id' => rand(1, 5),
                'product_type_id' => 1,
                'brand_id' => rand(1, 6),
                'image' => '6755737a44a4d4.25204277.jpeg',
                'serial_number' =>Str::random(25),
            ]);
        }
    }
}
