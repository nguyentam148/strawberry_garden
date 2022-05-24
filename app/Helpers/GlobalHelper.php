<?php

namespace App\Helpers;

use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

final class GlobalHelper
{
    public static function getAdminEmails(): array
    {
        return array_values(explode(';', config('project.admin_emails')));
    }

    public static function sendMailToAdmin(Mailable $mailable)
    {
        if (!empty($emails = self::getAdminEmails())) {
            Mail::to($emails)->send($mailable);
        }
    }
}
