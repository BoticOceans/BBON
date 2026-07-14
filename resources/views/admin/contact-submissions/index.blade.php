@extends('admin.layout')

@section('title', 'Contact Enquiries')

@section('content')
    <div class="page-head">
        <div>
            <h1>Contact Enquiries</h1>
            <p class="sub">Submissions from the public contact form.</p>
        </div>
    </div>

    <section class="panel table-wrap">
        <table>
            <thead>
                <tr>
                    <th>From</th>
                    <th>Requirement</th>
                    <th>Message</th>
                    <th>Channel</th>
                    <th>Received</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($submissions as $submission)
                    <tr>
                        <td>
                            <strong>{{ $submission->name }}</strong>
                            <div class="muted">{{ $submission->phone }}</div>
                            @if ($submission->email)
                                <div class="muted">{{ $submission->email }}</div>
                            @endif
                        </td>
                        <td>
                            @if ($submission->requirement_type)
                                <div>{{ $submission->requirement_type }}</div>
                            @endif
                            @if ($submission->product_category)
                                <div class="muted">{{ $submission->product_category }}</div>
                            @endif
                            @if ($submission->quantity)
                                <div class="muted">Qty: {{ $submission->quantity }}</div>
                            @endif
                            @if ($submission->customisation)
                                <div class="muted">{{ $submission->customisation }}</div>
                            @endif
                        </td>
                        <td style="max-width: 320px; white-space: normal;">{{ $submission->message ?: '—' }}</td>
                        <td class="muted" style="text-transform: capitalize;">{{ $submission->channel }}</td>
                        <td class="muted">{{ $submission->created_at?->format('d M Y, h:i A') }}</td>
                        <td>
                            <span class="badge {{ $submission->is_read ? 'badge-on' : 'badge-off' }}">
                                {{ $submission->is_read ? 'Read' : 'New' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <form method="POST" action="{{ route('admin.contact-submissions.mark-read', $submission) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn" type="submit">{{ $submission->is_read ? 'Mark Unread' : 'Mark Read' }}</button>
                                </form>
                                <form method="POST" action="{{ route('admin.contact-submissions.destroy', $submission) }}" onsubmit="return confirm('Delete this enquiry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="muted">No enquiries yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="pagination">{{ $submissions->links() }}</div>
@endsection
