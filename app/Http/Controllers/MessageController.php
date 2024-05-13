<?php

namespace App\Http\Controllers;

use App\Events\StoreLikeEvent;
use App\Http\Requests\Message\StoreComplaintRequest;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Requests\Message\UpdateRequest;
use App\Http\Resources\Message\MessageResource;
use App\Jobs\ProcessMessageJob;
use App\Models\Message;
use App\Service\NotificationService;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $message = Message::create($data);
        ProcessMessageJob::dispatch($data, $message);
        $message->loadCount('likedUsers');

        return MessageResource::make($message)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    public function toggleLikes(Message $message)
    {
        $res = $message->likedUsers()->toggle(auth()->id());
        if ($res['attached']) {
            NotificationService::store($message, null, "Вам поставили лайк");
        }
        broadcast(new StoreLikeEvent($message))->toOthers();
    }

    public function storeComplaint(StoreComplaintRequest $request, Message $message)
    {
        $data = $request->validated();
        $message->complaintedUsers()->attach(auth()->id(), $data);
        NotificationService::store($message, null, 'На Вас поступила жалоба');

        return MessageResource::make($message)->resolve();
    }
}
