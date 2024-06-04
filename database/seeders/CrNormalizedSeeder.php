<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrNormalizedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $normalizedJson = json_decode(
            file_get_contents(
                database_path() . '/normalized.json'
            ),
            true
        )[$this->table];

        foreach ($normalizedJson as $id => $data) {
            $insertArray = [];
            $insertArray['id'] = $id;
            foreach ($data as $key => $val) {
                if (strpos($key, 'LEGACY') !== false)
                    continue;
                if (is_array($val))
                    $val = json_encode($val);
                $insertArray[$key] = $val;
            }
            DB::table($this->table)->insert($insertArray);
        }
    }
}
