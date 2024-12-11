<?php

use App\SwitchState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

public function toggleSwitch(Request $request)
{
    $state = SwitchState::first();
    $state->is_on = !$state->is_on; // Toggle switch state
    $state->save();

    // Broadcast the switch state to all clients
    broadcast(new \App\Events\SwitchToggled($state->is_on));

    return response()->json(['success' => true, 'is_on' => $state->is_on]);
}
