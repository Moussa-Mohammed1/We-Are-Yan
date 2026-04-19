<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Donation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function donor(Request $request): View
    {
        $user = $request->user();

        return view('donor.pagedonor', [
            'user' => $user,
            'annonces' => Annonce::with('beneficiary')
                ->where('status', 'approved')
                ->latest()
                ->get(),
            'category' => Annonce::select('category')->distinct()->get(),
            'events' => Event::withCount('participants')
                ->withExists(['participants as joined_by_user' => fn ($query) => $query->where('users.id', $user->id)])
                ->orderBy('date_event')
                ->get(),
        ]);
    }

    public function admin(): View
    {
        $annonces = Annonce::with('beneficiary')->latest()->get();
        $pendingAnnonces = $annonces->where('status', 'pending');
        $reviewedAnnonces = $annonces->whereIn('status', ['approved', 'rejected'])->take(8);

        return view('admin.admindashbord', [
            'stats' => [
                'total_users' => User::count(),
                'donors' => User::where('role', 'donateur')->count(),
                'beneficiaries' => User::where('role', 'beneficiaire')->count(),
                'total_annonces' => $annonces->count(),
                'pending_annonces' => $pendingAnnonces->count(),
                'approved_annonces' => $annonces->where('status', 'approved')->count(),
                'rejected_annonces' => $annonces->where('status', 'rejected')->count(),
                'total_money_collected' => Donation::where('type', 'money')
                    ->where('status', 'paid')
                    ->sum('amount_or_qty'),
            ],
            'pendingAnnonces' => $pendingAnnonces,
            'reviewedAnnonces' => $reviewedAnnonces,
            'events' => Event::with(['participants:id,name,email'])
                ->withCount('participants')
                ->orderBy('date_event')
                ->get(),
        ]);
    }
}
