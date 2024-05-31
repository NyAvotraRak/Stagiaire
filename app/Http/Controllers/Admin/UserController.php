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

        // Si l'utilisateur actuel est le seul avec valider_user à true et qu'on essaie de le mettre à false
        if ($user->valider_user && !request('valider_user')) {
            // Vérifiez s'il existe au moins un autre utilisateur avec valider_user à true
            $otherValidatedUsers = User::where('valider_user', true)->where('id', '!=', $id)->count();

            if ($otherValidatedUsers === 0) {
                // Si aucun autre utilisateur n'est validé, renvoyez une erreur
                return redirect()->back()->with('error', 'Il doit y avoir au moins un utilisateur validé.');
            }
        }

        // Mettre à jour la valeur de valider_user en fonction de la case à cocher
        $user->valider_user = request('valider_user') ? true : false;
        $user->save();

        return redirect()->back()->with('success', 'Statut de validation mis à jour avec succès.');
    }
    public function destroy(User $user)
    {
        // dd($user->id);
        // Vérifiez s'il y a plus d'un utilisateur dans la table
        $userCount = User::count();

        // Vérifiez s'il y a plus d'un utilisateur validé
        $validatedUserCount = User::where('valider_user', true)->count();
        // dd($validatedUserCount);

        if ($userCount <= 1) {
            // Si c'est le seul utilisateur, ne pas permettre la suppression
            return redirect()->route('admin.utilisateur.index')->with('error', 'Vous ne pouvez pas supprimer le seul utilisateur.');
        }
        // Condition 2 : Si l'utilisateur actuel est le seul utilisateur validé, empêcher la suppression
        if ($user->valider_user && $validatedUserCount <= 1) {
            return redirect()->route('admin.utilisateur.index')->withErrors(['error' => 'Vous ne pouvez pas supprimer le seul utilisateur validé.']);
        }

        $user->delete();
        // return to_route('admin.utilisateur.index')->with('success', 'L\utilisateur a bien été Supprimé');
        return redirect()->route('admin.utilisateur.index')->with('success', 'L\utilisateur a bien été supprimé');
    }
}
