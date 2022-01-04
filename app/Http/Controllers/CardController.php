<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        \Validator::make($request->all(), [
            'task' => 'required',
            'date' => 'required',
            'columnId' => 'required',
        ])->validate();

        $card = new Card;

        $card->task = $request->task;
        $card->date = $request->date;
        $card->user_id = $request->user()->id;

        $card->save();

        // Add to pivot table

        $card->column()->attach($request->columnId);

        // Return data to view

        $data = [
            'id' => $card->id,
            'task' => $card->task,
            'date' => $card->date,
        ];

        return response()->json(['data' => $data], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        \Validator::make($request->all(), [
            'task' => 'required',
            'date' => 'required',
        ])->validate();

        $card = Card::find($id);

        $card->task = $request->task;
        $card->date = $request->date;

        $card->save();

        return response()->json(['message' => 'Actualizado correctamente'], 200);

    }

    public function changeColumn($id, $column)
    {

        $card = Card::find($id);

        $currentColumnId = $card->column()->first()->id;

        $card->column()->updateExistingPivot($currentColumnId, [
            'column_id' => $column
        ]);

        return response()->json(['message' => 'Actualizado correctamente'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
