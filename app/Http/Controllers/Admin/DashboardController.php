<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Visit;

class DashboardController extends Controller
{
    public function index()
    {
        $visits = Visit::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12))->mapWithKeys(function ($month) use ($visits) {
            return [$month => $visits->get($month, 0)];
        });

        return Inertia::render('Dashboard', [
            'visits' => $months->values()->toArray()
        ]);
    }
}
