<?php

use App\Models\KepalaSekolah;
use App\Models\LogoSekolah;
use App\Models\Post;
use App\Models\Setting;
use App\Models\SocialMedia;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!function_exists('webInfo')) {
    function webInfo()
    {
        return Setting::find(1);
    }
}
if (!function_exists('webSosmed')) {
    function webSosmed()
    {
        return SocialMedia::find(1);
    }
}

if (!function_exists('webLogo')) {
    function webLogo()
    {
        return LogoSekolah::find(1);
    }
}
if (!function_exists('kepSek')) {
    function kepSek()
    {
        return KepalaSekolah::find(1);
    }
}


if (!function_exists('userInfo')) {
    function userInfo()
    {
        return User::find(1);
    }
}

// date format
if (!function_exists('date_formatter')) {
    function date_formatter($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('LL');
    }
}

// STRIP WORDS

if (!function_exists('words')) {
    function words($value, $words = 15, $end = "...")
    {
        return Str::words(strip_tags($value), $words, $end);
    }
}

// chek if user online have internet connection

if (!function_exists('isOnline')) {
    function isOnline($site = "https://www.youtube.com/")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
}


// reading article duration

if (!function_exists('readDuration')) {
    function readDuration(...$text)
    {
        Str::macro('timeCounter', function ($text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);
            return (int)max(1, $minutesToRead);
        });
        return Str::timeCounter($text);
    }
}

// display home main latest post

if (!function_exists('single_latest_post')) {
    function single_latest_post()
    {
        return Post::where('isActive','=', 1)->with('author')
            ->with('subcategory')
            ->limit(1)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}


// display home main 6 latest post

if (!function_exists('lates_home_5post')) {
    function lates_home_5post()
    {
        return Post::where('isActive','=', 1)->with('author')
            ->with('subcategory')
            ->skip(1)
            ->limit(5)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
// display home random post

if (!function_exists('recommended_post')) {
    function recommended_post()
    {
        return Post::where('isActive','=', 1)->with('author')
            ->with('subcategory')
            ->limit(4)
            ->inRandomOrder()
            ->get();
    }
}

// post with number of posts

if (!function_exists('categories')) {
    function categories()
    {
        return SubCategory::whereHas('posts')
            ->with('posts', function($q){
                $q->where('isActive', '=', 1);
            })
            ->orderBy('subcategory_name', 'asc')
            ->get();
    }
}


// latest posts
if (!function_exists('lates_sidebar_post')) {
    function lates_sidebar_post($except = null, $limit = 4)
    {
        return Post::where('isActive','=', 1)->where('id', '!=', $except)
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

// tags
if (!function_exists('all_tags')) {
    function all_tags($except = null, $limit = 4)
    {
        return Post::where('post_tags', '!=', null)
        ->distinct()->pluck('post_tags')
        ->join(',');
    }
}

// PHP MAILER
if (!function_exists('sendMail')) {
    function sendMail($mailConfig){
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('EMAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('EMAIL_USERNAME');
        $mail->Password = env('EMAIL_PASSWORD');
        $mail->SMTPSecure = env('EMAIL_ENCRYPTION');
        $mail->Port = env('EMAIL_PORT');
        $mail->setFrom(env($mailConfig['mail_from_email']), $mailConfig['mail_from_name']);
        $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];

        if ($mail->send()) {
            return true;
        }else{
            return false;
        }
    }
}
