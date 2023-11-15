<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlapAdatFeltoltes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('megyek')->insert([
            ['nev' => 'Bács-Kiskun'],
            ['nev' => 'Baranya'],
            ['nev' => 'Békés'],
            ['nev' => 'Borsod-Abaúj-Zemplén'],
            ['nev' => 'Csongrád-Csanád'],
            ['nev' => 'Fejér'],
            ['nev' => 'Győr-Moson-Sopron'],
            ['nev' => 'Hajdú-Bihar'],
            ['nev' => 'Heves'],
            ['nev' => 'Jász-Nagykun-Szolnok'],
            ['nev' => 'Komárom-Esztergom'],
            ['nev' => 'Nógrád'],
            ['nev' => 'Pest'],
            ['nev' => 'Somogy'],
            ['nev' => 'Szabolcs-Szatmár-Bereg'],
            ['nev' => 'Tolna'],
            ['nev' => 'Vas'],
            ['nev' => 'Veszprém'],
            ['nev' => 'Zala'],
        ]);
        DB::table('varosok')->insert([
            ['nev' => 'Kecskemét', 'megyeId' => '1'],
            ['nev' => 'Pécs', 'megyeId' => '2'],
            ['nev' => 'Békéscsaba', 'megyeId' => '3'],
            ['nev' => 'Miskolc', 'megyeId' => '4'],
            ['nev' => 'Szeged', 'megyeId' => '5'],
            ['nev' => 'Székesfehérvár', 'megyeId' => '6'],
            ['nev' => 'Győr', 'megyeId' => '7'],
            ['nev' => 'Debrecen', 'megyeId' => '8'],
            ['nev' => 'Eger', 'megyeId' => '9'],
            ['nev' => 'Szolnok', 'megyeId' => '10'],
            ['nev' => 'Tatabánya', 'megyeId' => '11'],
            ['nev' => 'Salgótarján', 'megyeId' => '12'],
            ['nev' => 'Budapest', 'megyeId' => '13'],
            ['nev' => 'Kaposvár', 'megyeId' => '14'],
            ['nev' => 'Nyíregyháza', 'megyeId' => '15'],
            ['nev' => 'Szekszárd', 'megyeId' => '16'],
            ['nev' => 'Szombathely', 'megyeId' => '17'],
            ['nev' => 'Veszprém', 'megyeId' => '18'],
            ['nev' => 'Zalaegerszeg', 'megyeId' => '19'],
        ]);
    }
}
