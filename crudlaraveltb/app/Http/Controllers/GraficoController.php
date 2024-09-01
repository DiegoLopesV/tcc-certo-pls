<?php

namespace App\Http\Controllers;

use App\Models\Enfermaria;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
    public function showChart()
    {
        $data = Enfermaria::selectRaw("date_format(created_at, '%Y-%m-%d') as date, count(*) as aggregate")
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->get();

        return view('partials.grafico', compact('data'));
    }
}
