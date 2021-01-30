<?php

use App\Campaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('campaigns')->insert([
            'id' => Str::uuid(),
            'title' => 'Pengalangan Dana Gempa Padang',
            'description' => 'jhfskfhdskfjhskdjfhskdhfkjsdhfk',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('campaigns')->insert([
            'id' => Str::uuid(),
            'title' => 'Pengalangan Bencana Longsor Bogor',
            'description' => 'jhfskfhdskfjhskdjfhskdhfkjsdhfk',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
