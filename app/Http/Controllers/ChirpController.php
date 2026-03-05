<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ChirpController extends Controller

{
    use AuthorizesRequests;
    
    public function  index(){
      $chirps = Chirp::with("user")
      ->latest()
      ->take(50)
      ->get();
        return view("home", ["chirps"=>$chirps]);
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
        $validated = $request->validate([
            "message"=>"required|string|max:255"
        ],[
            "message.required"=>"Please write something!",
            "message.max"=>"Maximum of 255 characters."
        ]);

        Chirp::create([
            "message"=>$validated["message"]
        ]);

        auth()->user()->chirps()->create($validated);

        return redirect("/")->with("success", "Chirp Created");
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
    public function edit(Chirp $chirp)
    {
        $this->authorize("update", $chirp);
        return view("chirps.edit",compact("chirp"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize("update", $chirp);
          $validated = $request->validate([
            "message"=>"required|string|max:255"
        ],[
            "message.required"=>"Please write something!",
            "message.max"=>"Maximum of 255 characters."
        ]);

        $chirp->update($validated);
        $this->authorize("update", $chirp);


        return redirect("/")->with("success", "Your chirp has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $chirp->delete();

        return redirect("/")->with("success", "Your chirp has been deleted");
    }
}
