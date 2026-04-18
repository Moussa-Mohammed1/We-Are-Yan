<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function create(): View
    {
        return view('admin.create_event');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1200'],
            'city' => ['required', 'string', 'max:255'],
            'date_event' => ['required', 'date', 'after_or_equal:today'],
        ]);

        Event::create($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'event-created');
    }

    public function participate(Request $request, Event $event): RedirectResponse
    {
        $request->user()->events()->syncWithoutDetaching([$event->id]);

        return back()->with('status', 'event-participated');
    }
}
