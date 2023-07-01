<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionResource;
use App\Models\Collections;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CollectionResource::collection(Collections::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required'
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        $photoUrl = '';
        if($request->file('image')){
            $fileName = $request->file('image')->getClientOriginalName();
            $newName = time() . "-" . $fileName;
            $request->file('image')->move(public_path('/img/collections'), $newName);
            $photoUrl = url('/img/collections/'.$newName);
        }
        $input = ["name" => $request->name, "image"=> $photoUrl, "box_id" => $request->box_id];
        $collections = Collections::create($input);
        if($collections){
            $response = [
                "status" => true,
                "message" => "Collectio has been successfully created",
                "collection" => $collections
            ];
            return response($response, 200);
        }else{
            $response = [
                "status" => false,
                "message" => "Couldnt create collection",
                "collection" => $collections
            ];
            return response($response, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collection = Collections::find($id);
        if(is_null($collection)){
            return response()->json([
                "message"=> 'collection not found'
            ], 404);
        }
        return CollectionResource::make($collection);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collection = Collections::find($id);
        if(is_null($collection)){
            return response()->json([
                "message"=> 'collection not found'
            ], 404);
        }
        if($request->file('image')){
            $fileName = $request->file('image')->getClientOriginalName();
            $newName = time() . "-" . $fileName;
            $request->file('image')->move(public_path('/img/collections'), $newName);
            $photoUrl = url('/img/collections/'.$newName);
        
        }
       $collection->update($request->all());
       $response = [
        "status"=> true, 
        "message" => "collection updted successfully",
        "collection" => $collection
       ];
       return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
              
        $collection = Collections::find($id);
        if(is_null($collection)){
            $response = [
                "status" => false, 
                "message" => "cant find collection"
            ];
            return response($response, 404);
    }

    $collection->delete();
    $response = [
        "status" => true, 
        "message" => "collection deleted successfully"
    ];
    return response($response, 200);
    }
}
