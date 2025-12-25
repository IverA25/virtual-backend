<?php

namespace App\Http\Controllers;

use App\Enums\MessageHttp;
use App\Http\Requests\StoreCompraCursoRequest;
use App\Http\Resources\GeneralCollection;
use App\Models\CompraCurso;
use App\Services\CompraCursoService;
use App\Services\CursoEstudianteService;
use App\Services\CursoService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Reverb\Loggers\Log;

class CompraCursoController extends Controller
{
    protected $compraCursoService;
    protected $cursoService;
    protected $cursoEstudianteService;
    public function __construct(CompraCursoService $compraCursoService, CursoService $cursoService, CursoEstudianteService $cursoEstudianteService)
    {
        $this->compraCursoService = $compraCursoService;
        $this->cursoService = $cursoService;
        $this->cursoEstudianteService = $cursoEstudianteService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CompraCurso::active();

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
        $compraCursos = $query->paginate($perPage);

        return new GeneralCollection($compraCursos);
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
    public function store(StoreCompraCursoRequest $request)
    {
        $userId = Auth::user()->id;
        $now = Carbon::now('America/La_Paz');
        $fechaHora = $now->toDateTimeString();
        $curso = $this->cursoService->obtenerUno($request->curso_id);
        $montoProfesor = $curso->precio * ($curso->porcentaje_prof / 100);

        DB::beginTransaction();
        try {
            $data = [
                'curso_id' => $request->curso_id,
                'user_id' => $userId,
                'monto' => $curso->precio,
                'porcentaje_prof' => $curso->porcentaje_prof,
                'monto_prof' => $montoProfesor,
                'fecha_compra' => $fechaHora,
            ];
            $compraCurso = $this->compraCursoService->store($data);

            $dataCursoEstudiante = [
                'curso_id' => $request->curso_id,
                'user_id' => $userId,
                'monto' => $curso->precio,
                'fecha' => $fechaHora
            ];
            $cursoEstudiante = $this->cursoEstudianteService->store($dataCursoEstudiante);

            DB::commit();
            return response()
                ->json([
                    'message' => MessageHttp::CREADO_CORRECTAMENTE,
                    'data' => $compraCurso
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error al registrar',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompraCurso $compraCurso)
    {
        if ($compraCurso) {
            $data = [
                'message' => MessageHttp::OBTENIDO_CORRECTAMENTE,
                'data' => $compraCurso
            ];
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompraCurso $compraCurso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompraCurso $compraCurso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompraCurso $compraCurso)
    {
        $compraCurso = $this->compraCursoService->destroy($compraCurso);
        return response()
            ->json([
                'message' => MessageHttp::ELIMINADO_CORRECTAMENTE,
                'data' => $compraCurso
            ]);
    }
    public function listarActivos()
    {
        $compraCursos = $this->compraCursoService->listarActivos();
        $data = [
            'message' => MessageHttp::OBTENIDOS_CORRECTAMENTE,
            'data' => $compraCursos
        ];
        return response()->json($data);
    }
}
