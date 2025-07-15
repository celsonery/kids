<?php

namespace App\Http\Controllers;

use App\Http\Requests\KidResultRequest;
use App\Http\Requests\StoreKidRequest;
use App\Http\Requests\UpdateKidRequest;
use App\Imports\KidImport;
use App\Models\Kid;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;

class KidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('kids/Import');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKidRequest $request): RedirectResponse
    {

        Excel::import(new KidImport, $request->file('file'));

        return redirect()->back()->with(
            'success', 'Arquivo importado com sucesso!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Kid $kid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kid $kid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKidRequest $request, Kid $kid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kid $kid)
    {
        //
    }

    public function result(KidResultRequest $request): void
    {
        if (!$request->validated()) {
            abort('Dados fornecidos inválidos');
        }

        $kid = Kid::where('name', get_initials($request['name']))
            ->where('cpf', get_cpf_short($request['cpf']))
            ->first();

        if (isset($kid['id'])) {
            redirect()->back()->with(
                'success', $kid->state
            );
        } else {
            redirect()->back()->with(
                'error', 'Situação não encontrada!'
            );
        }
    }
}
