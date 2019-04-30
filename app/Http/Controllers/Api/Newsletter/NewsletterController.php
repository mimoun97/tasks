<?php

namespace App\Http\Controllers\Api\Newsletter;

use Response;
use Newsletter;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletters\NewsletterStore;

class NewsletterController extends Controller
{
    /**
     * Store email in newsletter
     *
     * @param NewsletterStore $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsletterStore $request)
    {
        Log::debug('Subscribing user email: ' . $request->email);

        $result = Newsletter::subscribePending($request->email);
        if ($result) return $result;
        return Response::json([
            'message' => 'User already registered'
        ], 423);
    }
}
