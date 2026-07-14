<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    private const WHATSAPP_NUMBER = '919967132425';

    private const NOTIFY_EMAIL = 'bbonsportswear@gmail.com';

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'requirement_type' => ['nullable', 'string', 'max:100'],
            'product_category' => ['nullable', 'string', 'max:100'],
            'quantity' => ['nullable', 'string', 'max:100'],
            'customisation' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
            'channel' => ['required', 'in:whatsapp,email'],
        ]);

        $submission = ContactSubmission::create($data);

        $redirect = redirect()->route('contact')->with('status', "Thanks {$submission->name}, we've received your requirement and will reply within 1 working day.");

        if ($data['channel'] === 'whatsapp') {
            $redirect->with('open_url', 'https://wa.me/'.self::WHATSAPP_NUMBER.'?text='.rawurlencode($submission->summaryText()));
        } else {
            $redirect->with('open_url', 'mailto:'.self::NOTIFY_EMAIL.'?subject='.rawurlencode('Sportswear Enquiry from '.$submission->name).'&body='.rawurlencode($submission->summaryText()));
        }

        return $redirect;
    }
}
