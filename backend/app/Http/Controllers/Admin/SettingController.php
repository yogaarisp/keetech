<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'general' => SiteSetting::where('group', 'general')->get(),
            'hero' => SiteSetting::where('group', 'hero')->get(),
            'about' => SiteSetting::where('group', 'about')->get(),
            'contact' => SiteSetting::where('group', 'contact')->get(),
            'social' => SiteSetting::where('group', 'social')->get(),
            'stats' => SiteSetting::where('group', 'stats')->get(),
            'features' => SiteSetting::where('group', 'features')->get(),
            'footer' => SiteSetting::where('group', 'footer')->get(),
            'webhook' => SiteSetting::where('group', 'webhook')->get(),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $allInputs = $request->except(['_token', '_method']);
        $finalData = [];

        // 1. Process File Uploads First (highest priority)
        foreach ($request->allFiles() as $key => $file) {
            $path = $file->store('settings', 'public');
            
            // Map keys like 'hero_image_file' to 'hero_image'
            $targetKey = str_ends_with($key, '_file') ? substr($key, 0, -5) : $key;
            $finalData[$targetKey] = $path;
        }

        // 2. Process Text Inputs
        foreach ($allInputs as $key => $value) {
            if ($value === null) continue;

            // Handle potential URL suffixes like 'company_logo_url' -> 'company_logo'
            $targetKey = str_ends_with($key, '_url') ? substr($key, 0, -4) : $key;

            // Only use text input if a file wasn't already uploaded for this key
            if (!isset($finalData[$targetKey])) {
                $finalData[$targetKey] = $value;
            }
        }

        // 3. Sync with DB
        foreach ($finalData as $key => $value) {
            if (is_object($value)) continue;

            $setting = \App\Models\SiteSetting::where('key', $key)->first();
            
            if ($setting) {
                // Keep the same group if it exists
                $setting->update(['value' => $value ?? '']);
            } else {
                // Create new with default group (this shouldn't happen often with seeders)
                \App\Models\SiteSetting::create([
                    'key' => $key,
                    'value' => $value ?? '',
                    'group' => 'general'
                ]);
            }
        }

        return back()->with('success', 'Pengaturan situs berhasil diperbarui.');
    }
}
