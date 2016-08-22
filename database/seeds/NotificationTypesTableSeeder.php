<?php

use Illuminate\Database\Seeder;
use App\Models\NotificationType;

class NotificationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            'Bài đăng của bạn đã được duyệt',
            'Vừa bình luận trong bài viết của bạn',
            'Vừa ủng hộ cho bài đăng của bạn'
        ];

        foreach ($messages as $mess) {
            $noti = new NotificationType();
            $noti->message = $mess;
            $noti->save();
        }
    }
}
