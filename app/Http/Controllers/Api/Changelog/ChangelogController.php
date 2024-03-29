<?php

namespace App\Http\Controllers\Api\Changelog;

use App\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListChangelog;

/**
 * Class ChangelogController
 * @package App\Http\Controllers\Tenant\Api\Changelog
 */
class ChangelogController extends Controller
{
    /**
     * @param ListChangelog $request
     * @return mixed
     */
    public function index(ListChangelog $request)
    {
        return map_collection(Log::all());
    }
}
