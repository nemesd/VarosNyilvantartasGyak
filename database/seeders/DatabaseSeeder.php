<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('county')->insert([
            ['name' => 'Bács-Kiskun'],
            ['name' => 'Baranya'],
            ['name' => 'Békés'],
            ['name' => 'Borsod-Abaúj-Zemplén'],
            ['name' => 'Csongrád-Csanád'],
            ['name' => 'Fejér'],
            ['name' => 'Győr-Moson-Sopron'],
            ['name' => 'Hajdú-Bihar'],
            ['name' => 'Heves'],
            ['name' => 'Jász-Nagykun-Szolnok'],
            ['name' => 'Komárom-Esztergom'],
            ['name' => 'Nógrád'],
            ['name' => 'Pest'],
            ['name' => 'Somogy'],
            ['name' => 'Szabolcs-Szatmár-Bereg'],
            ['name' => 'Tolna'],
            ['name' => 'Vas'],
            ['name' => 'Veszprém'],
            ['name' => 'Zala'],
        ]);
        DB::table('city')->insert([
            ['name' => 'Kecskemét', 'county_id' => '1'],
            ['name' => 'Pécs', 'county_id' => '2'],
            ['name' => 'Békéscsaba', 'county_id' => '3'],
            ['name' => 'Miskolc', 'county_id' => '4'],
            ['name' => 'Szeged', 'county_id' => '5'],
            ['name' => 'Székesfehérvár', 'county_id' => '6'],
            ['name' => 'Győr', 'county_id' => '7'],
            ['name' => 'Debrecen', 'county_id' => '8'],
            ['name' => 'Eger', 'county_id' => '9'],
            ['name' => 'Szolnok', 'county_id' => '10'],
            ['name' => 'Tatabánya', 'county_id' => '11'],
            ['name' => 'Salgótarján', 'county_id' => '12'],
            ['name' => 'Budapest', 'county_id' => '13'],
            ['name' => 'Kaposvár', 'county_id' => '14'],
            ['name' => 'Nyíregyháza', 'county_id' => '15'],
            ['name' => 'Szekszárd', 'county_id' => '16'],
            ['name' => 'Szombathely', 'county_id' => '17'],
            ['name' => 'Veszprém', 'county_id' => '18'],
            ['name' => 'Zalaegerszeg', 'county_id' => '19'],
        ]);
    }
}
