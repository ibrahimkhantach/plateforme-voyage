<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Adventure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AventureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $aventures = Adventure::with('user')->paginate(10);
        return view("welcome",compact('aventures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("aventures.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "title" => "required|string|max:255",
            "destination" => "required|string|max:255",
            "details" => "required|string",
            'images' => 'array', 
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $userId = Auth::id() ;

        $folderName = 'aventures/' . date('Y-m-d_H-i-s') . '_' . $request->user()->id;

        Adventure::create([
            "title" => $request->title,
            "destination" => $request->destination,
            "details" => $request->details,
            "images" => $folderName , 
            "idUser" => $userId 
        ]);

        if($request->hasFile("images")){
            foreach ($request->file("images") as $image) {
                $image->store($folderName,"public") ;
            }
        }

        return redirect()->back()->with('success', 'Created Aventure successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getAventuresByDestination($destination){
        $aventures = Adventure::where("destination",$destination)->get() ;
        return view("aventures.getAventuresByDestination",compact("aventures")) ;
    }

}
