<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller 
{

    public function index(){
        return response() -> json(Publisher::all(), 200);
    }

    public function show($id)
    {
        $publisher = Publisher::find($id);

        if(!$publisher){
            return response()->json(['error' => 'Publisher not found'], 404);
        }

        return response()->json($publisher, 200);
    
    

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'country' => 'sometimes|string',
            'email' => 'sometimes|string',
            'phone' => 'sometimes|string',
        ]);

        $publisher = Publisher::create($request->all());
        return response()->json($publisher, 201);
    }


    public function update(Request $request, $id)
    {
        $publisher = Publisher::find($id);

        if(!$publisher){
            return response()->json(['error' => 'Publisher not found'], 404);
        }

        $publisher->update($request->all());
        return response()->json($publisher, 200);
    
    }

    public function destroy($id)
    {
        $publisher = Publisher::find($id);

        
        if(!$publisher){
            return response()->json(['error' => 'Publisher not found'], 404);
        }

        $publisher->delete();
        return response()->json(['message' => 'Publisher deleted'], 200);
    }
}