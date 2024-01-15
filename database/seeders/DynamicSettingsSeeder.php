<?php

namespace Database\Seeders;

use App\Models\DynamicSettings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DynamicSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // for dynamic logo_app and background_login
        // $dynamic_settings = ['logo_app', 'background_login'];

        // foreach ($dynamic_settings as $dynamic_setting) {
        //     if (!DynamicSettings::where('key', $dynamic_setting)->first()) {
        //         DynamicSettings::create([
        //             'key' => $dynamic_setting,
        //         ]);
        //     } else {
        //         echo "Dynamic Setting $dynamic_setting already exists.\n";
        //     }
        // }
    }
}
