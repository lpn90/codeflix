<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $series */
        $series = \CodeFlix\Models\Serie::all();
        factory(\CodeFlix\Models\Video::class, 100)
            ->create()
            ->each(function ($video) use ($series) {
                $num = rand(1, 3);
                if($num%2==0){
                    $serie = $series->random();
                    $video->series()->associate($serie);
                    $video->save();
                }
            });
    }
}
