<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pastel\PastelStoreRequest;
use App\Http\Requests\Pastel\UpdatePastelRequest;
use App\Http\Requests\Pastel\UpdatePhotoRequest;
use App\Http\Resources\Pastels as PastelsResource;
use App\Library\Services\PastelService;
use App\Models\Pastel;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PastelsController extends Controller
{
    /**
     * @var PastelService
     */
    private PastelService $pastelService;

    public function __construct(PastelService $pastelService)
    {
        $this->pastelService = $pastelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index()
    {
        $paginate ??= (int) request('paginate');
        return PastelsResource::collection(Pastel::paginate($paginate));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PastelStoreRequest $request
     * @return Response
     */
    public function store(PastelStoreRequest $request)
    {
        $data = request(['name', 'price']);
        $data['photo'] = $this->pastelService->storePastelPhoto($request);

        $pastel = Pastel::create($data);
        return response($pastel, 201);
    }

    /**
     * Get the pastel photo
     *
     * @param Pastel $pastel
     * @return BinaryFileResponse
     */
    public function photo(Pastel $pastel)
    {
        $file = storage_path("app/{$pastel->photo}");
        if (!file_exists($file)) {
            abort(404);
        }
        return response()->file($file);
    }

    /**
     * Display the specified resource.
     *
     * @param  Pastel  $pastel
     * @return JsonResponse
     */
    public function show(Pastel $pastel)
    {
        return response()->json($pastel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePastelRequest $request
     * @param Pastel $pastel
     * @return Response
     */
    public function update(UpdatePastelRequest $request, Pastel $pastel)
    {
        $pastel->fill(request(['name', 'price']));
        $pastel->save();

        return response($pastel, 201);
    }

    /**
     * Update pastel photo
     *
     * @param UpdatePhotoRequest $request
     * @param Pastel $pastel
     * @return ResponseFactory|Response
     */
    public function updatePhoto(UpdatePhotoRequest $request, Pastel $pastel)
    {
        if ($request->hasFile('photo')) {
            $pastel->photo = $this->pastelService->storePastelPhoto($request);
            $this->pastelService->deleteOldPhoto($pastel);
            $pastel->save();
        }

        return response($pastel, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pastel $pastel
     * @return Response
     * @throws \Exception
     */
    public function destroy(Pastel $pastel)
    {
        $pastel->delete();
        $pastel->save();

        return response(null, 204);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     */
    public function restore($id)
    {
        Pastel::withTrashed()->find((int) $id)->restore();
        return response(null,201);
    }
}
