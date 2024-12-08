<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['jobs' => function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', Carbon::now());
        }])->orderBy('first_name')->get();
        
        $usersWithJobs = $users->map(function ($user) {
            $age = Carbon::parse($user->birth_date)->age;
            $allJobs = $user->jobs->pluck('company_name')->toArray(); // Liste de tous les noms d'emplois
        
            return [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'age' => $age,
                'current_jobs' => $allJobs, // Liste complète des emplois
            ];
        });
    
        return response()->json([
            'success' => true,
            'data' => $usersWithJobs
        ]);
    
    }
    // Créer une user
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'birth_date' => [
                    'required',
                    'date',
                    'before:today',
                    'after:' . now()->subYears(150)->toDateString(),
                ],
            ]);

            $user = User::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Utilisateur créé avec succès.'
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Erreur de validation des données.'
            ], 422);
        } 
    }



}
