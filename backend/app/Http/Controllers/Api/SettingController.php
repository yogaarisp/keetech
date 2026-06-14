<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'general' => SiteSetting::getGroup('general'),
                'hero' => SiteSetting::getGroup('hero'),
                'about' => SiteSetting::getGroup('about'),
                'contact' => SiteSetting::getGroup('contact'),
                'social' => SiteSetting::getGroup('social'),
                'stats' => SiteSetting::getGroup('stats'),
                'features' => SiteSetting::getGroup('features'),
                'footer' => SiteSetting::getGroup('footer'),
            ],
        ]);
    }
}
