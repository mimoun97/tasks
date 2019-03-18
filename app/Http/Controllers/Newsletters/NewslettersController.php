<?php

namespace App\Http\Controllers\Newsletters;

use App\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletters\NewsletterIndex;

class NewslettersController extends Controller
{
    /**
     * Index.
     *
     * @param NewsletterIndex $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(NewsletterIndex $request)
    {
        $newsletter = collect(Newsletter::getMembers());
        return view('tenants.newsletters.index', compact('newsletter'));
    }
}
