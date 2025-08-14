<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController
{

    public function index(): JsonResponse
    {
        return response()->json(Event::all());
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'color' => 'required|string|max:7',
        ]);

        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'color' => 'required|string|max:7',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());
        return response()->json($event);
    }

}
