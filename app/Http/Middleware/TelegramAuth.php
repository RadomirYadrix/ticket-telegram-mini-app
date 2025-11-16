<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TelegramAuth
{
    public function handle(Request $request, Closure $next)
    {
        $initData = $request->get('initData') ?? $request->header('X-Init-Data');
        if (!$initData) {
            return response()->json(['error' => 'No initData'], 401);
        }

        parse_str($initData, $parsed);
        $hash = $parsed['hash'];
        unset($parsed['hash']);

        $dataCheckArr = [];
        foreach ($parsed as $key => $value) {
            $dataCheckArr[] = $key . '=' . $value;
        }
        sort($dataCheckArr);

        $dataCheckString = implode("\n", $dataCheckArr);

        $secretKey = hash_hmac('sha256', config('telegram.bot_token'), 'WebAppData', true);
        $computedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        if (!hash_equals($hash, $computedHash)) {
            return response()->json(['error' => 'Invalid hash'], 401);
        }

        $user = json_decode($parsed['user'], true);
        $userModel = \App\Models\User::firstOrCreate(
            ['telegram_id' => $user['id']],
            [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'] ?? null,
                'username' => $user['username'] ?? null,
            ]
        );

        $request->attributes->add(['telegram_user' => $userModel]);

        return $next($request);
    }
}
