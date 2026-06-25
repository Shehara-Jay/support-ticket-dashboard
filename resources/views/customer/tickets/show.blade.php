<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size: 22px; font-weight: bold; color: #111827;">
                Ticket Details
            </h2>
            <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                View your support ticket details and continue the conversation.
            </p>
        </div>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 900px; margin: 0 auto; padding: 0 20px;">

            @if (session('success'))
                <div style="background-color: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background-color: white; border-radius: 12px; padding: 30px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">

                <h3 style="font-size: 24px; font-weight: bold; color: #111827; margin-bottom: 20px;">
                    {{ $ticket->subject }}
                </h3>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 25px;">
                    <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px;">
                        <p style="font-size: 13px; color: #6b7280;">Category</p>
                        <p style="font-weight: bold; color: #111827;">{{ $ticket->category }}</p>
                    </div>

                    <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px;">
                        <p style="font-size: 13px; color: #6b7280;">Priority</p>
                        <p style="font-weight: bold; color: #111827;">{{ $ticket->priority }}</p>
                    </div>

                    <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px;">
                        <p style="font-size: 13px; color: #6b7280;">Status</p>
                        <p style="font-weight: bold; color: #111827;">{{ $ticket->status }}</p>
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <h4 style="font-size: 18px; font-weight: bold; color: #111827; margin-bottom: 10px;">
                        Description
                    </h4>

                    <div style="background-color: #f9fafb; padding: 18px; border-radius: 8px; color: #374151; line-height: 1.6;">
                        {{ $ticket->description }}
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <h4 style="font-size: 18px; font-weight: bold; color: #111827; margin-bottom: 10px;">
                        Conversation
                    </h4>

                    @if ($ticket->replies->count() > 0)
                        <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                            @foreach ($ticket->replies as $reply)

                                @if ($reply->user->role === 'admin')
                                    <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px; border-left: 4px solid #2563eb;">
                                @else
                                    <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px; border-left: 4px solid #16a34a;">
                                @endif

                                    <p style="font-weight: bold; color: #111827; margin-bottom: 6px;">
                                        {{ $reply->user->name }}

                                        @if ($reply->user->role === 'admin')
                                            <span style="background-color: #dbeafe; color: #1d4ed8; padding: 2px 6px; border-radius: 999px; font-size: 11px; margin-left: 6px;">
                                                Admin
                                            </span>
                                        @else
                                            <span style="background-color: #dcfce7; color: #166534; padding: 2px 6px; border-radius: 999px; font-size: 11px; margin-left: 6px;">
                                                Customer
                                            </span>
                                        @endif

                                        <span style="font-size: 12px; color: #6b7280; font-weight: normal;">
                                            replied on {{ $reply->created_at->format('Y-m-d H:i') }}
                                        </span>
                                    </p>

                                    <p style="color: #374151; line-height: 1.6;">
                                        {{ $reply->message }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #6b7280; margin-bottom: 20px;">
                            No replies yet.
                        </p>
                    @endif

                    <form method="POST" action="{{ route('customer.tickets.storeReply', $ticket) }}">
                        @csrf

                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 14px; font-weight: bold; color: #374151; margin-bottom: 8px;">
                                Add Reply
                            </label>

                            <textarea name="message"
                                      rows="5"
                                      placeholder="Type your reply..."
                                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">{{ old('message') }}</textarea>

                            @error('message')
                                <p style="color: #dc2626; font-size: 14px; margin-top: 8px;">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit"
                                style="background-color: #16a34a; color: white; padding: 12px 20px; border-radius: 8px; border: none; font-weight: bold; cursor: pointer;">
                            Submit Reply
                        </button>
                    </form>
                </div>

                <a href="{{ route('customer.tickets.index') }}"
                   style="background-color: #6b7280; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
                    Back to Tickets
                </a>

            </div>

        </div>
    </div>
</x-app-layout>