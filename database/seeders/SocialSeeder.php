<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert(array(
            ['name' => 'Instagram', 'icon_path' => 'images/instagram.png', 'base_url' => 'https://www.instagram.com/'],
            ['name' => 'Facebook', 'icon_path' => 'images/facebook.png', 'base_url' => 'https://www.facebook.com/'],
            ['name' => 'Twitter', 'icon_path' => 'images/twitter.png', 'base_url' => 'https://twitter.com/'],
            ['name' => 'Youtube', 'icon_path' => 'images/youtube.png', 'base_url' => 'https://www.youtube.com/channel/'],
            ['name' => 'Phone', 'icon_path' => 'images/phone.png', 'base_url' => 'callto:'],
            ['name' => 'Email', 'icon_path' => 'images/email.png', 'base_url' => 'mailto:'],
            ['name' => 'Line', 'icon_path' => 'images/line.png', 'base_url' => ''],
            ['name' => 'LinkedIn', 'icon_path' => 'images/linkedin.png', 'base_url' => 'https://www.linkedin.com/in/'],
            ['name' => 'TikTok', 'icon_path' => 'images/tiktok.png', 'base_url' => 'https://vt.tiktok.com/'],
            ['name' => 'WeChat', 'icon_path' => 'images/wechat.png', 'base_url' => ''],
            ['name' => 'Clubhouse', 'icon_path' => 'images/clubhouse.png', 'base_url' => 'https://www.clubhouse.com/@'],
            ['name' => 'stand.fm', 'icon_path' => 'images/stand.fm.png', 'base_url' => 'https://stand.fm/channels/'],
            ['name' => 'Snapchat', 'icon_path' => 'images/snapchat.png', 'base_url' => 'https://www.snapchat.com/add/'],
            ['name' => 'Website', 'icon_path' => 'images/website.png', 'base_url' => ''],
            ['name' => '名刺管理アプリ', 'icon_path' => 'images/eight.png', 'base_url' => ''],
        ));
    }
}
