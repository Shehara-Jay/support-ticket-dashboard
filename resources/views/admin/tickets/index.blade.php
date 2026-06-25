<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size: 22px; font-weight: bold; color: #111827;">
                Admin Ticket Management
            </h2>
            <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                View, filter, and manage all customer support tickets.
            </p>
        </div>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

            <div style="background-color: white; border-radius: 12px; padding: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    <div>
                        <h3 style="font-size: 20px; font-weight: bold; color: #111827;">
                            All Tickets
                        </h3>
                        <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                            Tickets submitted by customers will appear here.
                        </p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                        style="background-color: #6b7280; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                        Back to Dashboard
                    </a>
                </div>

                <form method="GET" action="{{ route('admin.tickets.index') }}"
                    style="display: flex; gap: 15px; align-items: end; margin-bottom: 25px; background-color: #f9fafb; padding: 18px; border-radius: 10px;">

                    <div>
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #374151; margin-bottom: 6px;">
                            Status
                        </label>
                        <select name="status"
                            style="padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; min-width: 180px;">
                            <option value="">All Statuses</option>
                            <option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 13px; font-weight: bold; color: #374151; margin-bottom: 6px;">
                            Priority
                        </label>
                        <select name="priority"
                            style="padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; min-width: 180px;">
                            <option value="">All Priorities</option>
                            <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Urgent" {{ request('priority') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <button type="submit"
                        style="background-color: #2563eb; color: white; padding: 11px 20px; border-radius: 8px; border: none; font-weight: bold; cursor: pointer;">
                        Filter
                    </button>

                    <a href="{{ route('admin.tickets.index') }}"
                        style="background-color: #111827; color: white; padding: 11px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                        Reset
                    </a>
                </form>

                @if ($tickets->count() > 0)
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f3f4f6;">
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Customer</th>
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
                            <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                {{ $ticket->user->name }}
                            </td>

                            <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                {{ $ticket->subject }}
                            </td>

                            <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                {{ $ticket->category }}
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
                <div style="text-align: center; padding: 50px; border: 2px dashed #d1d5db; border-radius: 12px;">
                    <h3 style="font-size: 20px; font-weight: bold; color: #111827;">
                        No tickets found
                    </h3>

                    <p style="color: #6b7280; margin-top: 12px;">
                        No tickets match your selected filters.
                    </p>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>