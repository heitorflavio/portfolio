<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visit;
use Inertia\Inertia;

class VisitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $visits = Visit::paginate(12);
        return Inertia::render('Visits', [
            'visits' => $visits
        ]);
    }
}
