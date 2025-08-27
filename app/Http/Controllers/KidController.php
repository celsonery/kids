<?php

namespace App\Http\Controllers;

use App\Http\Requests\KidImportRequest;
use App\Http\Requests\KidResultRequest;
use App\Http\Requests\StoreKidRequest;
use App\Http\Requests\UpdateKidRequest;
use App\Imports\KidImport;
use App\Models\Kid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;

class KidController extends Controller
{
    public function index()
    {
        return Auth::user()->kids();
    }

    public function create(): Response
    {
        return Inertia::render('kids/Import');
    }

    public function result(KidResultRequest $request)
    {
        if (!$request->validated()) {
            abort('Dados fornecidos inválidos');
        }

        $kid = Kid::where('name', get_initials($request['name']))
            ->where('cpf', get_cpf_short($request['cpf']))
            ->first();


        if (isset($kid['id'])) {
            return response()->json($kid);
        } else {
            redirect()->back()->with(
                'error', 'Situação não encontrada!'
            );
        }
    }

    public function import(KidImportRequest $request)
    {
        Excel::import(new KidImport, $request->file('file'));

        return redirect()->back()->with(
            'success', 'Arquivo importado com sucesso!'
        );
    }
}
