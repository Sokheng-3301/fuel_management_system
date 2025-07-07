<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ShiftSelect;
use Illuminate\Http\Request;

class ShiftSelectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $delete_status = '';
        // dd($request->input());
        $request->validate([
            'shift_kh' => 'required|string|max:255|unique:shift_selects,shift_kh',
            'shift_en' => 'required|string|max:255|unique:shift_selects,shift_en',
        ]);

        if ($request->delete_status) {
            $delete_status = 1;
        } else {
            $delete_status = 0;
        }
        $addShift = ShiftSelect::create([
            'shift_kh' => $request->shift_kh,
            'shift_en' => $request->shift_en,
            'delete_status' => $delete_status,
            'created_by' => auth()->user()->id,
        ]);

        if ($addShift == true) {
            return redirect()->back()->with('success', __("Add shift has successfully."));
        } else {
            return redirect()->back()->with(['error' => __("Failed to add shift."), 'show_form' => true]);
        }
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
        // $data['shifts'] = ShiftSelect::with('user')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        // $data['employees'] = User::where('account_status', 1)->orderBy('id', 'desc')->get();


        // $data['update'] = false;
        // $data['update_shift'] = true;
        // $data['shift_select'] = ShiftSelect::findOrFail($id);
        // return view('backend.shift.form', $data);
        $shift_select = ShiftSelect::findOrFail($id);
        return response()->json(['message' => true, 'shift_select' => $shift_select]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->input());
        $checkItem = ShiftSelect::findOrFail($id);
        $delete_status = '';
        // dd($request->input());
        $request->validate([
            'shift_kh_update' => 'required|string|max:255|unique:shift_selects,shift_kh,' . $id,
            'shift_en_update' => 'required|string|max:255|unique:shift_selects,shift_en,' . $id,
        ]);

        if ($request->delete_status) {
            $delete_status = 1;
        } else {
            $delete_status = 0;
        }
        $addShift = $checkItem->update([
            'shift_kh' => $request->shift_kh_update,
            'shift_en' => $request->shift_en_update,
            'delete_status' => $delete_status,
            'updated_by' => auth()->user()->id,
        ]);

        if ($addShift == true) {
            return redirect()->back()->with('success', __("Update shift has successfully."));
        } else {
            return redirect()->back()->with(['error' => __("Failed to update shift."), 'show_form_update' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = ShiftSelect::find($id);

        if ($supplier) {
            // Check if the supplier is currently marked as deleted
            if ($supplier->delete_status == 1) {
                // Mark the supplier as deleted
                $supplier->update([
                    'delete_status' => 0, // Set delete status to 0 (deleted)
                    'deleted_by' => auth()->user()->id, // Assuming the user is authenticated
                    'deleted_at' => now(), // Set the deleted date to now
                ]);
                return response()->json(['message' => __('Shift moved to trash successfully.')]);
            } else {
                // Restore the supplier
                $supplier->update([
                    'delete_status' => 1 // Set delete status to 1 (restored)
                ]);
                return response()->json(['message' => __('Shift restored successfully.')]);
            }
        } else {
            // If the supplier does not exist, return an error message
            return response()->json(['error' => __('Shift not found.')], 404);
        }
    }
}
