<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = resource_path('data.json');
        $json = json_decode(file_get_contents($data), true);

        foreach ($json as $even_data) {
            Event::create($even_data);
        }
    }
}
