<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestResource;
use App\Models\Film;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RequestResource::collection(ModelsRequest::all());
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return RequestResource::make(ModelsRequest::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $modelrequest = ModelsRequest::find($id);
        if($request->selected == 'accept'){
            $modelrequest->request_status = "Резерв подтвержден";
            $modelrequest->save();
        }elseif($request->selected == 'dontaccept'){
            $modelrequest->request_status = "Резерв не подтвержден";
            $modelrequest->save();
        }elseif($request->selected == 'canceled'){
            $modelrequest->request_status = "Заявка отменена";
            $modelrequest->save();
        }elseif($request->selected == 'done'){
            $film = Film::find($modelrequest->film_id);
            $film->length = $film->length - $modelrequest->size;
            $film->save();
            $modelrequest->request_status = "Заявка выполнена";
            $modelrequest->save();
        }elseif($request->selected == 'reserv'){
            $modelrequest->request_status = "В резервации";
            $modelrequest->save();
        }
        $response = [
            "status" => true,
            "message" => "Request status has been updated successfully",
            "request" => RequestResource::make($modelrequest)
        ];
        return response( $response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
