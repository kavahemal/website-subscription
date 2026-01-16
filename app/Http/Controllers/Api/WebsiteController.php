<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::withCount(['posts', 'subscriptions'])
            ->latest()
            ->get();

        return WebsiteResource::collection($websites);
    }
}
