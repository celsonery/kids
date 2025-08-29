<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $overviews = Kid::selectRaw("
            COUNT(CASE WHEN state LIKE '1. Digitalizado%' THEN 1 END) as digitalizados,
            COUNT(CASE WHEN state LIKE '2. Em análise preliminar%' THEN 1 END) as analisados,
            COUNT(CASE WHEN state LIKE '4. Distribuído para relator%' THEN 1 END) as distribuidos,
            COUNT(CASE WHEN state LIKE '6. Arquivado - FAL%' THEN 1 END) as arquivados_fal
        ")->first();

        return Inertia::render('Dashboard', [
            'overviews' => collect([
                'Digitalizados' => $overviews->digitalizados,
                'Analisados' => $overviews->analisados,
                'Distribuídos' => $overviews->distribuidos,
                'Arquivados' => $overviews->arquivados_fal,
            ])->map(fn($valor, $chave) => [
                'name' => $chave,
                'data' => $valor
            ])->values(),
            'kids' => auth()->user()->kids,
        ]);
    }
}
