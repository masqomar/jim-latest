<?php

namespace App\Http\Controllers;

use App\Models\DigiflazzAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DigiflazzWebhookController extends Controller
{
    public function index(Request $request)
    {
        $secret = DigiflazzAccount::select('secret_key')->first()->secret_key;

        $post_data = file_get_contents('php://input');
        $signature = hash_hmac('sha1', $post_data, $secret);
        \Log::info($signature);

        if ($request->header('X-Hub-Signature') == 'sha1=' . $signature) {
            \Log::info(json_decode($request->getContent(), true));
        }
    }
}
