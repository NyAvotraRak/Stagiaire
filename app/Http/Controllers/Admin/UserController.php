<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateValidation($id)
    {
        $user = User::findOrFail($id);

        // Mettre à jour la valeur de valider_user en fonction de la case à cocher
        $user->valider_user = request('valider_user') ? true : false;
        $user->save();

        return redirect()->back()->with('success', 'Statut de validation mis à jour avec succès.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        // return to_route('admin.utilisateur.index')->with('success', 'L\utilisateur a bien été Supprimé');
        return redirect()->route('admin.utilisateur.index')->with('success', 'L\utilisateur a bien été supprimé');
    }
}
