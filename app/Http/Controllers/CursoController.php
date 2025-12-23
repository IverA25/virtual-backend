<?php

namespace App\Http\Controllers;

use App\Enums\MessageHttp;
use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Http\Resources\GeneralCollection;
use App\Models\Curso;
use App\Services\CursoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    protected $cursoService;
    public function __construct(CursoService $cursoService)
    {
        $this->cursoService = $cursoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Curso::active();

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
        $cursos = $query->paginate($perPage);

        return new GeneralCollection($cursos);
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
    public function store(StoreCursoRequest $request)
    {
        if ($request->hasFile('url_portada')) {
            $filePortada = $request->file('url_portada');
            $path = $filePortada->store('uploads/portadas/cursos', 'public');
        } else {
            $path = null;
        }

        $idUser = Auth::user()->id;

        $data = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'url_portada' => $path,
            'precio' => $request->precio,
            'porcentaje_prof' => $request->porcentaje_prof,
            'profesor_id' => $request->profesor_id,
            'materia_id' => $request->materia_id,
            'usuario_id' => $idUser,
        ];

        $curso = $this->cursoService->store($data);

        return response()
            ->json([
                'message' => MessageHttp::CREADO_CORRECTAMENTE,
                'data' => $curso
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        if ($curso) {
            $data = [
                'message' => MessageHttp::OBTENIDO_CORRECTAMENTE,
                'data' => $curso
            ];
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        $data = $request->only([
            'nombre',
            'descripcion',

            'precio',
            'porcentaje_prof',
            'profesor_id',
            'materia_id'
        ]);
        if ($request->hasFile('url_portada')) {
            $filePortada = $request->file('url_portada');
            $path = $filePortada->store('uploads/portadas/cursos', 'public');

            $data['url_portada'] = $path;
        }
        $curso = $this->cursoService->update($data, $curso->id);
        return response()
            ->json([
                'message' => MessageHttp::ACTUALIZADO_CORRECTAMENTE,
                'data' => $curso
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso = $this->cursoService->destroy($curso);
        return response()
            ->json([
                'message' => MessageHttp::ELIMINADO_CORRECTAMENTE,
                'data' => $curso
            ]);
    }
    public function listarActivos()
    {
        $cursos = $this->cursoService->listarActivos();
        $data = [
            'message' => MessageHttp::OBTENIDOS_CORRECTAMENTE,
            'data' => $cursos
        ];
        return response()->json($data);
    }
}
