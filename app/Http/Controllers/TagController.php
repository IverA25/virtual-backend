<?php

namespace App\Http\Controllers;

use App\Constants\Estado;
use App\Enums\MessageHttp;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\GeneralCollection;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tag::active();

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
        $tags = $query->paginate($perPage);

        return new GeneralCollection($tags);
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
    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create([
            'nombre' => $request->nombre,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0
        ]);

        $data = [
            'message' => MessageHttp::CREADO_CORRECTAMENTE,
            'data' => $tag
        ];
        return response()
            ->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        if ($tag) {
            $data = [
                'message' => MessageHttp::OBTENIDO_CORRECTAMENTE,
                'data' => $tag
            ];
            return response()->json($data);
        }
    }
    public function listarActivos()
    {
        $tags = $this->tagService->listarActivos();
        $data = [
            'message' => MessageHttp::OBTENIDOS_CORRECTAMENTE,
            'data' => $tags
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->only([
            'nombre',
            'estado',
            'es_eliminado'
        ]));
        $data = [
            'message' => MessageHttp::ACTUALIZADO_CORRECTAMENTE,
            'data' => $tag
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->es_eliminado   = 1;
        $tag->save();
        $data = [
            'message' => MessageHttp::ELIMINADO_CORRECTAMENTE,
            'data' => $tag
        ];
        return response()->json($data);
    }
}
