<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size: 22px; font-weight: bold; color: #111827;">
                My Support Tickets
            </h2>
            <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                View and manage your submitted support requests.
            </p>
        </div>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">

            @if (session('success'))
            <div style="background-color: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
            @endif

            <div style="background-color: white; border-radius: 12px; padding: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">

                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 20px; font-weight: bold; color: #111827;">
                        Ticket List
                    </h3>
                    <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                        All tickets created by you will appear here.
                    </p>
                </div>

                @if ($tickets->count() > 0)
                <div style="margin-bottom: 20px; text-align: right;">
                    <a href="{{ route('customer.tickets.create') }}"
                        style="background-color: #2563eb; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
                        + Create Ticket
                    </a>
                </div>

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f3f4f6;">
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Subject</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Category</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Priority</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Status</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Created</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <td style="padding: 12px; border: 1px solid #e5e7eb;">{{ $ticket->subject }}</td>
                            <td style="padding: 12px; border: 1px solid #e5e7eb;">{{ $ticket->category }}</td>
                            <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                @if ($ticket->priority === 'Low')
                                <span style="background-color: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    Low
                                </span>
                                @elseif ($ticket->priority === 'Medium')
                                <span style="background-color: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    Medium
                                </span>
                                @elseif ($ticket->priority === 'High')
                                <span style="background-color: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    High
                                </span>
                                @else
                                <span style="background-color: #7f1d1d; color: white; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    Urgent
                                </span>
                                @endif
                            </td>

                            <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                @if ($ticket->status === 'Open')
                                <span style="background-color: #dbeafe; color: #1d4ed8; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    Open
                                </span>
                                @elseif ($ticket->status === 'In Progress')
                                <span style="background-color: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    In Progress
                                </span>
                                @elseif ($ticket->status === 'Resolved')
                                <span style="background-color: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    Resolved
                                </span>
                                @else
                                <span style="background-color: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold;">
                                    Closed
                                </span>
                                @endif
                            </td>
                            <td style="padding: 12px; border: 1px solid #e5e7eb;">{{ $ticket->created_at->format('Y-m-d') }}</td>
                            <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                <a href="{{ route('customer.tickets.show', $ticket) }}"
                                    style="background-color: #111827; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none;">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div style="text-align: center; padding: 50px; border: 2px dashed #d1d5db; border-radius: 12px;">
                    <h3 style="font-size: 20px; font-weight: bold; color: #111827;">
                        No tickets found
                    </h3>

                    <p style="color: #6b7280; margin: 12px 0 25px;">
                        You have not created any support tickets yet.
                    </p>

                    <a href="{{ route('customer.tickets.create') }}"
                        style="background-color: #2563eb; color: white; padding: 12px 22px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
                        + Create Ticket
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>