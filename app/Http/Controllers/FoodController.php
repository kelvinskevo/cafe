<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        return view('admin.food.index')->with('foods', $foods);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload separately
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/user_images'), $imageName);
            $validated['image'] = $imageName;
        }

        Food::create($validated);

        // Redirect or return response
        return redirect()->route('foods.index')->with('message', 'Food Added Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('admin.food.edit')->with('food', $food);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateFoodRequest $request, Food $food)
    {
        $validated = $request->validated();

        // Handle image upload separately
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($food->image) {
                $oldImagePath = public_path('admin/user_images/' . $food->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/user_images'), $imageName);
            $validated['image'] = $imageName;
        } else {
            // If no new image is uploaded, retain the old image
            $validated['image'] = $food->image;
        }

        // Update the food record
        $food->update($validated);

        return redirect()->route('foods.index')->with('message', 'Food updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        // Check if the image exists and delete it from the folder
        if (file_exists(public_path('admin/user_images/' . $food->image))) {
            unlink(public_path('admin/user_images/' . $food->image));
        }

        $food->delete();
        return redirect()->route('foods.index')->with('message', 'Food Deleted Successfully');
    }
}
