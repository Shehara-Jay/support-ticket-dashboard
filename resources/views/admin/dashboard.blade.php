<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size: 22px; font-weight: bold; color: #111827;">
                Admin Dashboard
            </h2>
            <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                Overview of support ticket activity and customer requests.
            </p>
        </div>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 18px; margin-bottom: 30px;">

                <div style="background-color: white; padding: 22px; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">
                    <p style="font-size: 14px; color: #6b7280;">Total Tickets</p>
                    <h3 style="font-size: 30px; font-weight: bold; color: #111827; margin-top: 8px;">
                        {{ $totalTickets }}
                    </h3>
                </div>

                <div style="background-color: white; padding: 22px; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">
                    <p style="font-size: 14px; color: #6b7280;">Open</p>
                    <h3 style="font-size: 30px; font-weight: bold; color: #2563eb; margin-top: 8px;">
                        {{ $openTickets }}
                    </h3>
                </div>

                <div style="background-color: white; padding: 22px; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">
                    <p style="font-size: 14px; color: #6b7280;">In Progress</p>
                    <h3 style="font-size: 30px; font-weight: bold; color: #d97706; margin-top: 8px;">
                        {{ $inProgressTickets }}
                    </h3>
                </div>

                <div style="background-color: white; padding: 22px; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">
                    <p style="font-size: 14px; color: #6b7280;">Resolved</p>
                    <h3 style="font-size: 30px; font-weight: bold; color: #16a34a; margin-top: 8px;">
                        {{ $resolvedTickets }}
                    </h3>
                </div>

                <div style="background-color: white; padding: 22px; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">
                    <p style="font-size: 14px; color: #6b7280;">Closed</p>
                    <h3 style="font-size: 30px; font-weight: bold; color: #dc2626; margin-top: 8px;">
                        {{ $closedTickets }}
                    </h3>
                </div>

            </div>

            <div style="background-color: white; border-radius: 12px; padding: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    <div>
                        <h3 style="font-size: 20px; font-weight: bold; color: #111827;">
                            Recent Tickets
                        </h3>
                        <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                            Latest customer support tickets.
                        </p>
                    </div>

                    <a href="{{ route('admin.tickets.index') }}"
                       style="background-color: #2563eb; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                        View All Tickets
                    </a>
                </div>

                @if ($recentTickets->count() > 0)
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Customer</th>
                                <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Subject</th>
                                <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Priority</th>
                                <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Status</th>
                                <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Created</th>
                                <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($recentTickets as $ticket)
                                <tr>
                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                        {{ $ticket->user->name }}
                                    </td>

                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                        {{ $ticket->subject }}
                                    </td>

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

                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                        {{ $ticket->created_at->format('Y-m-d') }}
                                    </td>

                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                        <a href="{{ route('admin.tickets.show', $ticket) }}"
                                           style="background-color: #111827; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none;">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="text-align: center; padding: 45px; border: 2px dashed #d1d5db; border-radius: 12px;">
                        <h3 style="font-size: 18px; font-weight: bold; color: #111827;">
                            No tickets available
                        </h3>
                        <p style="color: #6b7280; margin-top: 10px;">
                            Customer tickets will appear here after submission.
                        </p>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>