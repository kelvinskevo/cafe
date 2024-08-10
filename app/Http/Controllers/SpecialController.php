<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecialRequest;
use App\Http\Requests\UpdateSpecialRequest;
use App\Models\Special;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SpecialController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Get the start of the current week (Monday)
        $startOfWeek = now()->startOfWeek();

        // Get the end of the current week (Sunday)
        $endOfWeek = now()->endOfWeek();

        // Get specials for the current week
        $current = Special::whereBetween('week_start', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get specials for future weeks
        $future = Special::where('week_start', '>', $endOfWeek)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get specials for previous weeks
        $previous = Special::where('week_start', '<', $startOfWeek)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all specials
        $all = Special::orderBy('created_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.specials.index', compact('current', 'future', 'previous', 'all'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.specials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialRequest $request)
    {
        // Get validated data
        $data = $request->validated();

        // Handle image upload separately
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/special_images'), $imageName);
            $data['image'] = $imageName; // Correctly add the image name to $data
        }

        // Create the special entry
        Special::create($data);

        // Redirect back with a success message
        return redirect()->route('specials.index')->with('message', 'Special created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Special $special)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Special $special)
    {
        return view('admin.specials.edit')->with('special', $special);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateSpecialRequest $request, Special $special)
    {
        // Get validated data
        $data = $request->validated();

        // Handle image upload separately
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($special->image && file_exists(public_path('admin/special_images/' . $special->image))) {
                unlink(public_path('admin/special_images/' . $special->image));
            }

            // Upload the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/special_images'), $imageName);
            $data['image'] = $imageName;
        }

        // Update the special entry
        $special->update($data);

        // Redirect back with a success message
        return redirect()->route('specials.index')->with('message', 'Special updated successfully');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Special $special)
    {
        // Delete the image if it exists
        if ($special->image && Storage::disk('public')->exists($special->image)) {
            Storage::disk('public')->delete($special->image);
        }

        // Delete the special
        $special->delete();

        return redirect()->route('specials.index')->with('message', 'Special deleted successfully');
    }
}
