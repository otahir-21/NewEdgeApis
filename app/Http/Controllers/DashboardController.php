<?php

namespace App\Http\Controllers;

use App\Models\Project;   // Import your Project model
use App\Models\Form;      // Import your Form model for property_forms
use App\Models\Developer; // Import your Developer model
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function getDashboardData(): JsonResponse
    {
        // Get total counts
        $totalProjects = Project::count();
        $totalQuotations = Form::count(); // Adjust if your forms table is different
        $totalDevelopers = Developer::count();

        // Prepare response data
        $data = [
            'total_projects' => $totalProjects,
            'total_quotations' => $totalQuotations,
            'total_developers' => $totalDevelopers,
        ];

        return response()->json($data);
    }
}