<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'contact_phone',   'value' => '+225 77 58 59 58'],
            ['key' => 'contact_email',   'value' => 'info@becs.com.lb'],
            ['key' => 'contact_address', 'value' => 'Abidjan, Côte d\'Ivoire'],
            ['key' => 'contact_hours',   'value' => 'Monday — Friday: 8:00 AM — 5:00 PM'],
            ['key' => 'company_name',    'value' => 'BECS'],
            ['key' => 'company_tagline', 'value' => 'Bureau of Engineering & Contracting Services'],
            ['key' => 'map_embed_url',   'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.1325536335607!2d-3.897265600000001!3d5.2418625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ea5311959121%3A0x44cde3299e737930!2zNjRSMytQM1gsIEFiaWRqYW4sINiz2KfYrdmEINin2YTYudin2Kw!5e0!3m2!1sar!2slb!4v1783428698918!5m2!1sar!2slb'],
            ['key' => 'facebook_url',    'value' => '#'],
            ['key' => 'instagram_url',   'value' => '#'],
            ['key' => 'linkedin_url',    'value' => '#'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
