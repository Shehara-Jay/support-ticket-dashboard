<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size: 22px; font-weight: bold; color: #111827;">
                Create Support Ticket
            </h2>
            <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">
                Submit a new support request to the admin team.
            </p>
        </div>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 750px; margin: 0 auto; padding: 0 20px;">

            <div style="background-color: white; border-radius: 12px; padding: 30px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">

                <form method="POST" action="{{ route('customer.tickets.store') }}">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: bold; color: #374151; margin-bottom: 8px;">
                            Subject
                        </label>

                        <input type="text"
                               name="subject"
                               value="{{ old('subject') }}"
                               placeholder="Example: Login issue"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">

                        @error('subject')
                            <p style="color: #dc2626; font-size: 14px; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: bold; color: #374151; margin-bottom: 8px;">
                            Category
                        </label>

                        <select name="category"
                                style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                            <option value="General">General</option>
                            <option value="Billing">Billing</option>
                            <option value="Technical">Technical</option>
                            <option value="Account">Account</option>
                        </select>

                        @error('category')
                            <p style="color: #dc2626; font-size: 14px; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: bold; color: #374151; margin-bottom: 8px;">
                            Priority
                        </label>

                        <select name="priority"
                                style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                            <option value="Low">Low</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="High">High</option>
                            <option value="Urgent">Urgent</option>
                        </select>

                        @error('priority')
                            <p style="color: #dc2626; font-size: 14px; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 14px; font-weight: bold; color: #374151; margin-bottom: 8px;">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="6"
                                  placeholder="Explain the issue clearly..."
                                  style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">{{ old('description') }}</textarea>

                        @error('description')
                            <p style="color: #dc2626; font-size: 14px; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a href="{{ route('customer.tickets.index') }}"
                           style="background-color: #6b7280; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                            Back
                        </a>

                        <button type="submit"
                                style="background-color: #2563eb; color: white; padding: 12px 24px; border-radius: 8px; border: none; font-weight: bold; cursor: pointer;">
                            Submit Ticket
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>