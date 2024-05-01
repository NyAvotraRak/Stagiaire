<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy(User $user)
    {
        $user->delete();
        // return to_route('admin.utilisateur.index')->with('success', 'L\utilisateur a bien été Supprimé');
        return redirect()->route('admin.utilisateur.index')->with('success', 'L\utilisateur a bien été supprimé');
    }
}
