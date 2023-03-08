<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class Common
{
    public static function getSavePath() {
        $rel_path = 'images/profile';
        $images_path = public_path('storage/images/profile');
        if (!file_exists($images_path)) {
            File::makeDirectory($images_path, $mode = 0777, true, true);
        }

        $rel_path = $rel_path . '/' . date("Y");
        $year_path = $images_path . '/' . date("Y");
        if (!file_exists($year_path)) {
            File::makeDirectory($year_path, $mode = 0777, true, true);
        }

        $rel_path = $rel_path . '/' . date("m");
        $month_path = $year_path . '/' . date("m");
        if (!file_exists($month_path)) {
            File::makeDirectory($month_path, $mode = 0777, true, true);
        }

        return array('abs_path' => $month_path, 'rel_path' => $rel_path);
    }

    public static function sendMail($mail_data) {
        $template = $mail_data['template'];
        $template_data = $mail_data['template_data'];
        $inner_data = $mail_data['inner_data'];

        config(['mail.from.address' => $inner_data['from_mail_address']]);
        config(['mail.from.name' => $inner_data['from_mail_name']]);

        $flag = true;

        try {
            Mail::send($template, ['template_data' => $template_data], function($message) use ($inner_data)
            {
                $message->to($inner_data['to_mail_address'], $inner_data['to_mail_name'])->subject($inner_data['subject']);
                
                if(isset($inner_data['attach_file']) && !empty($inner_data['attach_file'])) {
                    $message->attach(public_path('storage/' . $inner_data['attach_file']));
                }   
            });
        } catch(\Swift_TransportException $e) {
            $flag = false;      
        }

        return $flag;
    }
}