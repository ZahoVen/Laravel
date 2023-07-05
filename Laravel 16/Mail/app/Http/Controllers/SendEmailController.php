<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index()
    {
        Mail::to('receive-email-id')->send(new NotifyMail());

        if (Mail::failuers()) {
            echo "Sorry! Please try again later";
        } else {
            echo "Great! Successfully send in your mail";
        }
    }
}
