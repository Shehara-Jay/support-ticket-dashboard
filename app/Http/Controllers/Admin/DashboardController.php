<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'Open')->count();
        $inProgressTickets = Ticket::where('status', 'In Progress')->count();
        $resolvedTickets = Ticket::where('status', 'Resolved')->count();
        $closedTickets = Ticket::where('status', 'Closed')->count();

        $recentTickets = Ticket::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'resolvedTickets',
            'closedTickets',
            'recentTickets'
        ));
    }
}