<?php

namespace App\Http\Controllers;

use App\Events\Messages;
use App\Models\Annonce;
use App\Models\Conversation;
use App\Models\Donation;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function start(Request $request, Annonce $annonce): View
    {
        abort_if($annonce->status !== 'approved', 404);

        $annonce->load('beneficiary');
        $user = $request->user();

        abort_if($annonce->beneficiary_id === $user->id, 403);

        $donation = Donation::firstOrCreate(
            [
                'annonce_id' => $annonce->id,
                'donor_id' => $user->id,
                'type' => 'chat',
            ],
            [
                'donor_name' => $user->name,
                'donor_email' => $user->email,
                'amount_or_qty' => 'Chat',
                'method' => null,
                'message' => null,
                'status' => 'pending',
            ]
        );

        $conversation = Conversation::firstOrCreate(
            ['donation_id' => $donation->id],
            [
                'donor_id' => $user->id,
                'beneficiary_id' => $annonce->beneficiary_id,
            ]
        );

        return $this->show($request, $conversation);
    }

    public function show(Request $request, Conversation $conversation): View
    {
        $this->authorizeConversation($request, $conversation);

        $conversation->load(['donor', 'beneficiary', 'donation.annonce', 'messages.sender']);

        return view('chat.show', [
            'user' => $request->user(),
            'conversation' => $conversation,
        ]);
    }

    public function storeMessage(Request $request, Conversation $conversation): RedirectResponse|JsonResponse
    {
        $this->authorizeConversation($request, $conversation);

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->user()->id,
            'content' => $validated['content'],
        ]);

        $message->load('sender');

        broadcast(new Messages($message))->toOthers();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => [
                    'id' => $message->id,
                    'content' => $message->content,
                    'sender_id' => $message->sender_id,
                    'sender_name' => $message->sender?->name ?? 'User',
                ],
            ]);
        }

        return back();
    }

    private function authorizeConversation(Request $request, Conversation $conversation): void
    {
        $user = $request->user();

        abort_unless($conversation->donor_id === $user->id || $conversation->beneficiary_id === $user->id, 403);
    }
}
