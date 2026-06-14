<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'service_type' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contact = Contact::create($validated);

        // Send webhook to n8n if configured
        $this->sendWebhook($contact);

        return response()->json([
            'message' => 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.',
            'data' => $contact,
        ], 201);
    }

    private function sendWebhook(Contact $contact): void
    {
        $webhookUrl = SiteSetting::getValue('n8n_webhook_url');

        if (!$webhookUrl) {
            return;
        }

        try {
            Http::timeout(5)->post($webhookUrl, [
                'event' => 'new_contact',
                'data' => [
                    'id' => $contact->id,
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'service_type' => $contact->service_type,
                    'message' => $contact->message,
                    'submitted_at' => $contact->created_at->toIso8601String(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::warning('n8n webhook failed: ' . $e->getMessage());
        }
    }
}
