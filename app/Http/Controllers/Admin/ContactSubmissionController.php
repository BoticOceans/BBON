<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactSubmissionController extends Controller
{
    public function index(): View
    {
        return view('admin.contact-submissions.index', [
            'submissions' => ContactSubmission::latest()->paginate(20),
        ]);
    }

    public function markRead(ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->update(['is_read' => ! $contactSubmission->is_read]);

        return redirect()->route('admin.contact-submissions.index');
    }

    public function destroy(ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->delete();

        return redirect()->route('admin.contact-submissions.index')->with('status', 'Enquiry deleted.');
    }
}
