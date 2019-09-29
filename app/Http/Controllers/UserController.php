<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
     /*
     |--------------------------------------------------------------------------
     | User Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles the user functions not handled by the other
     | controllers.
     |
     */

    /**
     * Deletes a user from the database
     *
     */
    public function destroy(){

        Auth::User()->delete();
        return Redirect::to('/');
    }
}
