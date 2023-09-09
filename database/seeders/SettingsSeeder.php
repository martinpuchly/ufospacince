<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            'title' => 'Kontak - zoznam emailových adries na ktoré bude odoslaný email.', 
            'key' => 'contact_to_emails', 
            'value' => 'martin.puchly@gmail.com,', 
            'info' => 'jednotlivé emailové adresy delené čiarkou'
        ]);

    }
}
