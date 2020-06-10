<?php
namespace App\Http\Controllers;


use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Clients as ClientResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index()
    {
        $paginate ??= (int) request('paginate');
        return ClientResource::collection(Client::paginate($paginate));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return JsonResponse
     */
    public function store(StoreClientRequest $request)
    {
        $data = request([
            'name',
            'email',
            'telephone',
            'birthdate',
            'address',
            'complement',
            'neighborhood',
            'zipcode',
        ]);

        $client = Client::create($data);

        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Client  $client
     * @return JsonResponse
     */
    public function show(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param Client $client
     * @return Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->fill(request([
            'name',
            'email',
            'telephone',
            'birthdate',
            'address',
            'complement',
            'neighborhood',
            'zipcode',
        ]));
        $client->save();

        return response($client, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Response
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        $client->delete();
        $client->save();

        return response(null, 204);
    }

    /**
     * Restore a deleted client
     * @param $id
     * @return ResponseFactory|Response
     */
    public function restore($id)
    {
        Client::withTrashed()->find((int) $id)->restore();
        return response(null,201);
    }
}
