<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TelegramController
{
    public function index(Request $request): View
    {
        return view('telegram.miniapp');
    }
}
