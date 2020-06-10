<?php
namespace App\Http\Controllers;


use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Orders as OrderResource;
use App\Library\Services\OrderService;
use App\Models\Client;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use App\Http\Resources\Orders as OrdersResource;

class OrdersController extends Controller
{

    /**
     * @var OrderService
     */
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index()
    {
        $paginate ??= (int) request('paginate');
        return OrdersResource::collection(Order::paginate($paginate));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $data = request([
            'client',
            'pastel',
        ]);

        $order = Order::create([
            'client_id' => $data['client'],
            'pastel_id' => $data['pastel'],
        ]);

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrdersResource|JsonResponse
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if (!$order->isReceived()) {
            abort(403, 'Order has already started preparing');
        }

        $order->fill([
            'client_id' => $request->get('client'),
            'pastel_id' => $request->get('pastel'),
        ]);
        $order->save();

        return response()->json($order, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     * @throws Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();
        $order->save();
        return response(null, 204);
    }

    /**
     * Restore a deleted client
     * @param $id
     * @return ResponseFactory|Response
     */
    public function restore($id)
    {
        Order::withTrashed()->find((int) $id)->restore();
        return response(null,201);
    }

    /**
     * @param Client $client
     * @return AnonymousResourceCollection
     */
    public function getOrdersByClient(Client $client)
    {
        $orders = Order::where('client_id', $client->id)->get();
        return OrderResource::collection($orders);
    }

    /**
     * Finish order and send email with sales detail
     *
     * @param Client $client
     * @return ResponseFactory|Response
     */
    public function finishOrder(Client $client)
    {
        $this->orderService->finishOrder($client);
        return response(null, 204);
    }
}
