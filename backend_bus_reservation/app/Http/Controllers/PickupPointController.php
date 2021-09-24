<?php

namespace App\Http\Controllers;

use App\PickupPoint;
use App\Http\Requests\createPickupPointRequest;
use Illuminate\Http\Request;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, PickupPoint $model)
    {
        return response()->json($model->where('user_id', '=', $id)->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createPickupPointRequest $request)
    {
        return response()->json(PickupPoint::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PickupPoint  $pickupPoint
     * @return \Illuminate\Http\Response
     */
    public function show(PickupPoint $pickupPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PickupPoint  $pickupPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(PickupPoint $pickupPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PickupPoint  $pickupPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PickupPoint $pickupPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PickupPoint  $pickupPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(PickupPoint $pickupPoint)
    {
        //
    }
}
