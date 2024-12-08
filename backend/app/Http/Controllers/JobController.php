<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function index()
    {
        try {
           
            $jobs = Job::with('user')->get();

            return response()->json([
                'success' => true,
                'data' => $jobs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function add(Request $request, $userId)
    {
        // Validation
        $request->validate([
            'company_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
    
        try {
            $job = Job::create([
                'user_id' => $userId,
                'company_name' => $request->company_name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
    
            return response()->json([
                'success' => true,
                'data' => $job,
                'message' => 'Emploi ajouté avec succès.',
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'ajout d\'un emploi', ['error' => $e]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

   

    public function jobsBetweenDates($userId, $startDate, $endDate)
    {
        $user = User::findOrFail($userId);

        return $user->jobs()
            ->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->get();
    }
}
