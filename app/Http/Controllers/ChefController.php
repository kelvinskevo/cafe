<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChefRequest;
use App\Http\Requests\UpdateChefRequest;
use App\Models\Chef;


class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chefs = Chef::orderBy('created_at', 'desc')->get();
        return view('admin.chefs.index')->with('chefs', $chefs);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chefs.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreChefRequest $request)
    {
        // Validate and get the validated data
        $validated = $request->validated();

        // Handle image upload separately
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/chefs_images'), $imageName);
            $validated['image'] = $imageName;
        }


        // Create a new chef record
        Chef::create($validated);

        // Redirect to the chefs list with a success message
        return redirect()->route('chefs.index')->with('message', 'Chef created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Chef $chef)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chef $chef)
    {
        return view('admin.chefs.edit')->with('chef', $chef);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChefRequest $request, Chef $chef)
    {

        $validated = $request->validated();

        // Handle image upload separately
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($chef->image) {
                $oldImagePath = public_path('admin/chefs_images/' . $chef->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/chefs_images'), $imageName);
            $validated['image'] = $imageName;
        } else {
            // If no new image is uploaded, retain the old image
            $validated['image'] = $chef->image;
        }

        // Update the food record
        $chef->update($validated);

        return redirect()->route('chefs.index')->with('message', 'Food updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chef $chef)
    {
        // Check if the image exists and delete it from the folder
        if (file_exists(public_path('admin/chefs_images/' . $chef->image))) {
            unlink(public_path('admin/chefs_images/' . $chef->image));
        }

        // Delete the chef record from the database
        $chef->delete();

        // Redirect to the chefs index page with a success message
        return redirect()->route('chefs.index')->with('message', 'Chef Deleted Successfully');
    }

    public function stored(StoreChefRequest $request)
    {

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/images'), $imageName);
            $validated['image'] = $imageName;
        }
    }
}
