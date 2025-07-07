<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shift;
use App\Models\ShiftSelect;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['shifts'] = Shift::orderBy('id', 'desc')->get();
        return view('backend.shift.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['shifts'] = ShiftSelect::with('user')->orderBy('id', 'desc')->get();
        $data['shift_selects'] = ShiftSelect::with('user')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['employees'] = User::where('account_status', 1)->orderBy('id', 'desc')->get();

        $data['update'] = false;
        $data['update_shift'] = false;
        return view('backend.shift.form', $data);
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
}
