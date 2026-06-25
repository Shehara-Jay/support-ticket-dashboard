<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Customer\TicketController as CustomerTicketController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Models\Ticket;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $userId = Auth::id();

    $totalTickets = Ticket::where('user_id', $userId)->count();
    $openTickets = Ticket::where('user_id', $userId)->where('status', 'Open')->count();
    $inProgressTickets = Ticket::where('user_id', $userId)->where('status', 'In Progress')->count();
    $resolvedTickets = Ticket::where('user_id', $userId)->where('status', 'Resolved')->count();
    $closedTickets = Ticket::where('user_id', $userId)->where('status', 'Closed')->count();

    $recentTickets = Ticket::where('user_id', $userId)
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalTickets',
        'openTickets',
        'inProgressTickets',
        'resolvedTickets',
        'closedTickets',
        'recentTickets'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes for logged-in users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer ticket routes
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/tickets', [CustomerTicketController::class, 'index'])->name('customer.tickets.index');
    Route::get('/customer/tickets/create', [CustomerTicketController::class, 'create'])->name('customer.tickets.create');
    Route::post('/customer/tickets', [CustomerTicketController::class, 'store'])->name('customer.tickets.store');
    Route::get('/customer/tickets/{ticket}', [CustomerTicketController::class, 'show'])->name('customer.tickets.show');
    Route::post('/customer/tickets/{ticket}/reply', [CustomerTicketController::class, 'storeReply'])->name('customer.tickets.storeReply');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::patch('/admin/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])->name('admin.tickets.updateStatus');
    Route::post('/admin/tickets/{ticket}/reply', [AdminTicketController::class, 'storeReply'])->name('admin.tickets.storeReply');
});

require __DIR__ . '/auth.php';
