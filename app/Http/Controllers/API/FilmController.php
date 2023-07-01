<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Film::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'collection_id' => 'required',
            'name' => 'required',
            'creator' => 'required',
            'code' => 'required',
            'width' => 'required',
            'height' => 'required',
            'namotka' => 'required',
            'min_order' => 'required',
            "length" => 'required'
            
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
            $request->file('image')->move(public_path('/img/films'), $newName);
            $photoUrl = url('/img/films/'.$newName);
        }
        $input = [
            "name" => $request->name,
            "creator" => $request->creator,
            "code" => $request->code,
            "width" => $request->width,
            "height" => $request->height,
            "namotka" => $request->namotka,
            "length" => $request->length,
            "min_order" => $request->min_order,
            "image"=> $photoUrl,
            "collection_id" => $request->collection_id
        ];
        $film = Film::create($input);
        if($film){
            $response = [
                "status" => true,
                "message" => "Film has been successfully created",
                "film" => $film
            ];
            return response($response, 200);
        }else{
            $response = [
                "status" => false,
                "message" => "Couldnt create film",
                "film" => $film
            ];
            return response($response, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Film::find($id);
        if(is_null($film)){
            return response()->json([
                "message"=> 'film not found'
            ], 404);
        }
        return $film;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $film = Film::find($id);
        if(is_null($film)){
            return response()->json([
                "message"=> 'film not found'
            ], 404);
        }
        if($request->file('image')){
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('/'),  $fileName);
            $photoUrl = url('img/'.$fileName);
            $request->image = $photoUrl;
        }
       $film->update($request->all());
       $response = [
        "status"=> true, 
        "message" => "film updted successfully",
        "film" => $film
       ];
       return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $film = Film::find($id);
        if(is_null($film)){
            $response = [
                "status" => false, 
                "message" => "cant find film"
            ];
            return response($response, 404);
    }

    $film->delete();
    $response = [
        "status" => true, 
        "message" => "film deleted successfully"
    ];
    return response($response, 200);
    }
}
