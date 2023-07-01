<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoxResource;
use App\Models\Boxes;
use App\Models\Collections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BoxResource::collection(Boxes::all());
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
            $request->file('image')->move(public_path('/img/user'), $newName);
            $photoUrl = url('/img/user/'.$newName);
        }
        $input = ["name" => $request->name, "image"=> $photoUrl];
        $boxes = Boxes::create($input);
        if($boxes){
            $response = [
                "status" => true,
                "message" => "Box has been successfully created",
                "box" => $boxes
            ];
            return response($response, 200);
        }else{
            $response = [
                "status" => false,
                "message" => "Couldnt create box",
                "box" => $boxes
            ];
            return response($response, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $box = Boxes::find($id);
        if(is_null($box)){
            return response()->json([
                "message"=> 'box not found'
            ], 404);
        }
        if($box){
            $response = [
                "status" => true, 
                "box" => BoxResource::make($box)
            ];
            return response($response, 200);
        }
            $response = [
                "status" => true, 
                "message" => "cant find box"
            ];
            return response($response, 400);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $box = Boxes::find($id);
        if(is_null($box)){
            return response()->json([
                "message"=> 'box not found'
            ], 404);
        }
        if($request->file('image')){
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('/'), $fileName);
            $photoUrl = url('/'.$fileName);
            $request->image = $photoUrl;
        }
       $box->update($request->all());
       $response = [
        "status"=> true, 
        "message" => "box updted successfully",
        "box" => $box
       ];
       return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $box = Boxes::find($id);
        if(is_null($box)){
            $response = [
                "status" => false, 
                "message" => "cant find box"
            ];
            return response($response, 404);
    }

    $box->delete();
    $response = [
        "status" => true, 
        "message" => "box deleted successfully"
    ];
    return response($response, 200);
    }   
    
}
