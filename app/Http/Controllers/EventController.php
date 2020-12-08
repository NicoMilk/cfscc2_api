<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::orderByDesc("date_start")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "type" => ["required", "string"],
            "description" => ["required", "string"],
            "date_start" => ["required", "date"],
            "date_end" => ["required", "date"],
            "price" => ["required", "numeric"], // TODO make price float !!!
            "slots" => ["required", "integer"],
            "slots_left" => ["integer"],
            "slots_taken" => ["integer", "nullable"],
        ]);

        if (
            Event::create([
                "type" => $request->type,
                "description" => $request->description,
                "date_start" => $request->date_start,
                "date_end" => $request->date_end,
                "price" => $request->price,
                "slots" => $request->slots,
                "slots_left" => $request->slots,
                "slots_taken" => $request->registered,
            ])
        ) {
            return response()->json(
                [
                    "success" => "Nouvel évènement créé avec succès",
                ],
                200
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            "type" => ["string", "nullable"],
            "description" => ["string", "nullable"],
            "date_start" => ["date", "nullable"],
            "date_end" => ["date", "nullable"],
            "price" => ["numeric", "nullable"], // TODO make price FLOAT !!!
            "slots" => ["integer", "nullable"],
            // 'slots_left' => ['integer', 'nullable'],
            // 'registered' => ['integer', 'nullable'],
        ]);

        if (
            $event->update([
                "type" => $request->type,
                "description" => $request->description,
                "date_start" => $request->date_start,
                "date_end" => $request->date_end,
                "price" => $request->price,
                "slots" => $request->slots,
                // 'slots_left' => $request->slots_left,
                // 'registered' => $request->registered,
            ])
        ) {
            return response()->json(
                [
                    "success" => "Évènement modifié avec succès",
                ],
                200
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // deletes registrations of the deleted event in the registrations table
        // Registration::where('id', $event->id)
        // ->delete();

        $event->delete();
        return response()->json(
            [
                "success" => "Evènement supprimé avec succès",
            ],
            200
        );

        // return redirect()->route(ROUTE.TO.EVENTS.INDEX)->with('success', "XXX has been deleted"); // TODO
    }
}
