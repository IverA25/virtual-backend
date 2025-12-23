<?php

namespace App\Http\Controllers;

use App\Enums\MessageHttp;
use App\Http\Resources\GeneralCollection;
use App\Models\TagCurso;
use App\Services\TagCursoService;
use Illuminate\Http\Request;

class TagCursoController extends Controller
{
    protected $tagCursoService;
    public function __construct(TagCursoService $tagCursoService)
    {
        $this->tagCursoService = $tagCursoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TagCurso::active();

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
        $tagCursos = $query->paginate($perPage);

        return new GeneralCollection($tagCursos);
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
        $data = [
            'curso_id' => $request->curso_id,
            'tag_id' => $request->tag_id
        ];
        $tagCurso = $this->tagCursoService->store($data);
        return response()
            ->json([
                'message' => MessageHttp::CREADO_CORRECTAMENTE,
                'data' => $tagCurso
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TagCurso $tagCurso)
    {
        if ($tagCurso) {
            $data = [
                'message' => MessageHttp::OBTENIDO_CORRECTAMENTE,
                'data' => $tagCurso
            ];
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TagCurso $tagCurso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TagCurso $tagCurso)
    {
        $data = $request->only([
            'curso_id',
            'tag_id'
        ]);
        $tagCurso = $this->tagCursoService->update($data, $tagCurso->id);
        return response()
            ->json([
                'message' => MessageHttp::ACTUALIZADO_CORRECTAMENTE,
                'data' => $tagCurso
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagCurso $tagCurso)
    {
        $tagCurso = $this->tagCursoService->destroy($tagCurso);
        return response()
            ->json([
                'message' => MessageHttp::ELIMINADO_CORRECTAMENTE,
                'data' => $tagCurso
            ]);
    }
    public function listarActivos()
    {
        $tagCursos = $this->tagCursoService->listarActivos();
        $data = [
            'message' => MessageHttp::OBTENIDOS_CORRECTAMENTE,
            'data' => $tagCursos
        ];
        return response()->json($data);
    }
}
