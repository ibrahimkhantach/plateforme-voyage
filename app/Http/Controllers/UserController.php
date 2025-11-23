<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::where('role',"user")->orderBy("created_at","desc")->paginate(10);
        return view("users.all",compact("users"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id) ;

        $user->delete();

        return redirect()->back()->with('success', 'User supprimée avec succès !');

    }

    public function totalUsersActif(){
        $totalActif = User::where('isActif', true)->count();
        return $totalActif ;
    }
}
