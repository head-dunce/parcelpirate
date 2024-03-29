<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    //public function destroy(Request $request): RedirectResponse
   // {
    //   $request->validateWithBag('userDeletion', [
    //        'password' => ['required', 'current_password'],
    //    ]);
//
     //   $user = $request->user();

      //  Auth::logout();

      //  $user->delete();

     //   $request->session()->invalidate();
      //  $request->session()->regenerateToken();

      //  return Redirect::to('/');
   // }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Retrieve all associated packages and delete them along with their images
        $packages = $user->packages; // Assuming you have a relation defined in your User model
        foreach ($packages as $package) {
            // Delete package images from storage
            if ($package->PackageImage) {
                Storage::delete('public/' . $package->PackageImage);
            }
            if ($package->PackageInvoiceImage) {
                Storage::delete('public/' . $package->PackageInvoiceImage);
            }

            // Delete the package record from the database
            $package->delete();
        }

        // Perform the user logout
        Auth::logout();

        // Delete the user
        $user->delete();

        // Invalidate and regenerate session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return Redirect::to('/')->with('status', 'Your account has been successfully deleted.');
    }







}
