<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Adventure;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use Illuminate\Support\Str; // To clean the filename


class AventureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aventures = Adventure::with('user')->orderBy("created_at","desc")->paginate(10);
        return view("welcome", compact('aventures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("aventures.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "destination" => "required|string|max:255",
            "details" => "required|string",
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $userId = Auth::id();
        $folderName = 'aventures/' . date('Y-m-d_H-i-s') . '_' . $userId;

        // Créer l'aventure
        $adventure = Adventure::create([
            "title" => $request->title,
            "destination" => $request->destination,
            "details" => $request->details,
            "images" => $folderName,
            "user_id" => $userId
        ]);

        // Uploader les images
        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $image) {
                $image->store($folderName, "public");
            }
        }

        return redirect()->back()->with('success', 'Adventure créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adventure = Adventure::findOrFail($id);
        
        
        return view("aventures.edit", compact('adventure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $adventure = Adventure::findOrFail($id);
        
        $images = $request->delete_images;
        //delete images :
        foreach ($images as $image) {
            if(Storage::disk("public")->exists($image)){
                Storage::disk("public")->delete($image);
            }
        }

        $request->validate([
            "title" => "required|string|max:255",
            "destination" => "required|string|max:255",
            "details" => "required|string",
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $adventure->update([
            "title" => $request->title,
            "destination" => $request->destination,
            "details" => $request->details,
        ]);

        // Ajouter les nouvelles images
        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $image) {
                $image->store($adventure->images, "public");
            }
        }

        return redirect()->back()->with('success', 'Adventure mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adventure = Adventure::findOrFail($id);
        

        // Supprimer le dossier et les images
        if (Storage::disk('public')->exists($adventure->images)) {
            Storage::disk('public')->deleteDirectory($adventure->images);
        }

        $adventure->delete();

        return redirect()->back()->with('success', 'Adventure supprimée avec succès !');
    }

    /**
     * Search adventures by destination and date range
     */
    public function search(Request $request)
    {
        // Valider les paramètres
        $request->validate([
            'destination' => 'nullable|string|max:255',
            'date_start' => 'nullable|date',
            'date_end' => 'nullable|date|after_or_equal:date_start',
        ]);

        $destination = $request->query("destination");
        $date_start = $request->query("date_start");
        $date_end = $request->query("date_end");

        $query = Adventure::with('user');

        // Filtre par destination
        if ($destination) {
            $query->where("destination", "like", "%" . $destination . "%")
            ->orderBy("created_at","desc")
            ;
        }

        // Filtre par plage de dates
        if ($date_start && $date_end) {
            $query->whereBetween("created_at", [$date_start, $date_end])
            ->orderBy("created_at","desc")
            ;
        }

        // Paginer les résultats
        $aventures = $query->paginate(10);

        return view("welcome", compact('aventures'));
    }

    public function show($user_id)
    {
        $aventures = Adventure::where('user_id', $user_id)->orderBy("created_at","desc")->paginate(10);
        return view("aventures.show", compact('aventures'));
    }

    public function dashboard(){
        $total = Adventure::count();

         $destinations = Adventure::select('destination', DB::raw('count(*) as total'))
        ->groupBy('destination')
        ->orderByDesc('total') // Order by most popular
        ->limit(3)
        ->get();

         $user = new UserController() ;
         $totalActif = $user->totalUsersActif() ;

        return view("dashboard",compact("total","destinations","totalActif")) ;
    }


    public function downloadPdf(){
       // 1. Get the current User
    $user = Auth::user();

    // 2. Get ONLY this user's adventures (and execute query with get())
    $aventures = Adventure::where('user_id', $user->id)
                          ->with('user') // Optional since we already have $user
                          ->get(); 

    // 3. Load the view
    // We pass both $aventures AND $user to the view
    $pdf = Pdf::loadView("aventures.pdf", compact("aventures", "user"));

    // 4. Generate Filename safely
    // We use $user->name, NOT $aventures->user...
    $filename = "aventures-user-" . Str::slug($user->name) . ".pdf";

    return $pdf->download($filename);
    }
   
}