<?php

namespace App\Http\Controllers;

use App\Enums\MessageHttp;
use App\Http\Resources\GeneralCollection;
use App\Models\CursoEstudiante;
use App\Services\CursoEstudianteService;
use Illuminate\Http\Request;

class CursoEstudianteController extends Controller
{
    protected $cursoEstudianteService;
    public function __construct(CursoEstudianteService $cursoEstudianteService)
    {
        $this->cursoEstudianteService = $cursoEstudianteService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CursoEstudiante::active();

        // Manejo de búsqueda
        if ($request->has('search')) {
            $search = json_decode($request->input('search'), true);
            $query->search($search);
        }

        // Manejo de ordenamiento
        if ($request->has('sort')) {
            $sort = json_decode($request->input('sort'), true);
            $query->sort($sort);
        }

        $perPage = $request->input('perPage', 10);
        $cursoEstudiantes = $query->paginate($perPage);

        return new GeneralCollection($cursoEstudiantes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CursoEstudiante $cursoEstudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CursoEstudiante $cursoEstudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CursoEstudiante $cursoEstudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CursoEstudiante $cursoEstudiante)
    {
        //
    }
    public function listarActivos()
    {
        $cursoEstudiantes = $this->cursoEstudianteService->listarActivos();
        $data = [
            'message' => MessageHttp::OBTENIDOS_CORRECTAMENTE,
            'data' => $cursoEstudiantes
        ];
        return response()->json($data);
    }
}
