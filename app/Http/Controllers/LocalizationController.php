<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setLanguage(Request $request)
    {
        $locale = $request->locale ?? config('app.locale');
        $request->session()->put('locale', $locale);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
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
}
