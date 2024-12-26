<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // String
        DB::table('courses')->insert([
            'description' => 'String instruments are a group of musical instruments that make sound by vibrating strings, which can be played by plucking,'
                            .' bowing, or striking the strings. They have been used in music for centuries and are known for their rich, expressive tones.',
            'objective' => 'The goal of learning string instruments is to develop skills in playing music, improve coordination,'
                            .' and express emotions through sound, while also gaining a better understanding of musical theory and techniques.',
            'trivia' => '<p>'
            .'<ul>'
                .'<li>Ancient Origins: The earliest known string instruments date back over 3,000 years, with discoveries like the "Lyre of Ur" from Mesopotamia.</li>'
                .'<li>Longest Strings: The piano, technically a string instrument, has strings over six feet long in its largest models.</li>'
                .'<li>Cultural Variations: Instruments like the sitar (India), koto (Japan), and balalaika (Russia) showcase the diversity of string instrument traditions around the world.</li>'
                .'<li>"Perfect Pitch" Instrument: The violin is often considered the closest instrument to the human voice in tonal range and expression.</li>'
                .'<li>Material Matters: Early violin strings were made from sheep gut, while modern strings often combine metal and synthetic materials for better durability and sound.</li>'
            .'</ul>'
            .'</p>',
            'category_id' => 1,
        ]);
        // Percussion
        DB::table('courses')->insert([
            'description' => 'Percussion instruments are musical instruments that produce sound when struck, shaken, or scraped.'
                            .' They include drums, tambourines, and cymbals, and are often used to keep rhythm in music.',
            'objective' => 'The goal of learning percussion instruments is to improve rhythm, coordination,'
                            .' and timing, while also gaining a deeper understanding of music through beats and patterns.',
            'trivia' => '<p>'
            .'<ul>'
                .'<li>Oldest Instrument: Archaeological evidence suggests that simple drums and rattles were some of the first musical instruments used by humans.</li>'
                .'<li>Largest Family: The percussion family is the most diverse in an orchestra, including instruments like the triangle, maracas, and gongs.</li>'
                .'<li>Cultural Roots: Percussion plays a central role in many cultural traditions, such as African drumming and Latin American samba.</li>'
                .'<li>The Gong Mystery: A well-played gong can produce a rich array of overtones, creating an almost "magical" resonance that seems to linger in the air.</li>'
                .'<li>Silent Partner: Instruments like the tambourine and castanets add subtle, yet essential, rhythmic texture to compositions.</li>'
            .'</ul>'
            .'</p>',
            'category_id' => 2,
        ]);
        // Aerophones
        DB::table('courses')->insert([
            'description' => 'Aerophones are musical instruments that make sound by using air, which is usually blown into or across them.'
                            .' Examples include flutes, trumpets, and saxophones, and they are known for their clear and flowing sounds.',
            'objective' => 'The goal of learning aerophone instruments is to develop the ability to control airflow and pitch,'
                            .' while also improving breath control and understanding musical patterns through sound.',
            'trivia' => '<p>'
            .'<ul>'
                .'<li>Oldest Instrument: The world\'s oldest known musical instrument is a flute made from a vulture\'s wing bone, estimated to be over 40,000 years old, discovered in Germany.</li>'
                .'<li>Circular Breathing: Players of instruments like the didgeridoo and certain flutes use a technique called circular breathing, allowing them to produce uninterrupted sound for minutes at a time.</li>'
                .'<li>Largest Trumpet: The world\'s largest playable trumpet, measuring over 105 feet long, was created in Germany and requires multiple people to operate.</li>'
                .'<li>Flute\'s Versatility: The flute is one of the only instruments found in nearly every culture worldwide, from Native American flutes to the Japanese shakuhachi.</li>'
                .'<li>Saxophone Origins: The saxophone, a relatively modern aerophone, was invented in 1840 by Adolphe Sax, combining characteristics of both brass and woodwind instruments.</li>'
            .'</ul>'
            .'</p>',
            'category_id' => 3,
        ]);
        // Idiophones
        DB::table('courses')->insert([
            'description' => 'Idiophones are musical instruments that produce sound by vibrating their own material when struck, shaken, or scraped.'
                            .' Examples include bells, cymbals, and maracas, and they are known for their sharp, clear sounds.',
            'objective' => 'The goal of learning idiophone instruments is to understand how different materials create sound,'
                            .' improve rhythm, and develop skills in making music with instruments that produce sound by vibrating themselves.',
            'trivia' => '<p>'
            .'<ul>'
                .'<li>Oldest Metal Idiophone: Bells, one of the earliest idiophones, were first crafted in ancient China over 3,000 years ago and used for both music and rituals.</li>'
                .'<li>Largest Xylophone: The largest playable xylophone is located in Japan and measures over 72 feet long, producing deep, resonant tones.</li>'
                .'<li>Glass Music: Glass idiophones, like the glass harmonica, were popular in the 18th century and even composed for by Mozart and Beethoven.</li>'
                .'<li>Symbolic Gongs: In Southeast Asia, gongs are often used to signify the beginning of important ceremonies or to ward off evil spirits.</li>'
                .'<li>Cowbell Fame: The humble cowbell, an idiophone, gained massive popularity in modern music due to its use in genres like rock and funk.</li>'
            .'</ul>'
            .'</p>',
            'category_id' => 4,
        ]);
        // Brass
        DB::table('courses')->insert([
            'description' => 'Brass instruments are musical instruments made of metal that produce sound when the player blows air through a mouthpiece,'
                            .' causing the lips to vibrate. Examples include trumpets, trombones, and tubas, and they are known for their loud, powerful sounds.',
            'objective' => 'The goal of learning brass instruments is to improve breath control, develop the ability to produce different pitches,'
                            .' and understand how to create music through the vibration of air inside the instrument.',
            'trivia' => '<p>'
            .'<ul>'
                .'<li>Longest Brass Instrument: The alphorn, a traditional Swiss brass instrument, can be over 12 feet long and is used to produce hauntingly beautiful tones across mountain valleys.</li>'
                .'<li>Tuba vs. Sousaphone: The sousaphone, named after John Philip Sousa, is a marching band-friendly version of the tuba, designed to be easier to carry.</li>'
                .'<li>First Valved Trumpet: The valved trumpet was invented in the early 19th century, revolutionizing the way brass instruments could play chromatic notes.</li>'
                .'<li>High Notes Challenge: The trumpet is capable of playing some of the highest notes in the orchestra, with skilled players reaching altissimo ranges.</li>'
                .'<li>French Horn\'s Twist: The French horn’s circular design involves over 12 feet of tubing coiled into its iconic shape.</li>'
            .'</ul>'
            .'</p>',
            'category_id' => 5,
        ]);
        // Electrophones
        DB::table('courses')->insert([
            'description' => 'Electrophones are musical instruments that create sound using electricity, either through electronic circuits or sound synthesizers.'
                            .' Examples include electric guitars, synthesizers, and electric pianos, and they are known for their wide range of sounds and effects.',
            'objective' => 'The goal of learning electrophone instruments is to understand how to create and control sounds using electronic technology,'
                            .' while improving skills in producing music through electronic devices or circuits.',
            'trivia' => '<p>'
            .'<ul>'
                .'<li>First Synthesizer: The first true synthesizer, the Moog synthesizer, was created in the 1960s and became a cornerstone of electronic music.</li>'
                .'<li>Theremin’s Ghostly Sound: The theremin, invented in 1920, is played without physical contact and is famous for its eerie, otherworldly tones, often used in sci-fi soundtracks.</li>'
                .'<li>Electric Guitar Revolution: The Fender Telecaster, introduced in 1950, was one of the first mass-produced electric guitars, revolutionizing music genres like rock and blues.</li>'
                .'<li>Keyboard Evolution: The digital piano mimics the acoustic piano but offers additional features like sound effects and portability.</li>'
            .'</ul>'
            .'</p>',
            'category_id' => 6,
        ]);
    }
}
