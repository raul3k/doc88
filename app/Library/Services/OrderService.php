<?php


namespace App\Library\Services;


use App\Notifications\OrderCompleted;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Order;
use App\Models\Sale;

class OrderService
{
    public function finishOrder(Client $client)
    {
        $ordersIds = $this->getAllOrdersByClient($client);
        $sale = $this->createNewSale($client, $ordersIds);
        $sale->save();
        $sale->notify(new OrderCompleted($sale));
    }

    public function getAllOrdersByClient(Client $client)
    {
        return $client
            ->orders()
            ->get()
            ->each(function($order){
                $order->status = Order::ORDER_DONE;
                $order->save();
                return $order->id;
            })
            ->reduce(fn($carry, $order) => "{$carry},{$order->id}");
    }

    public function createNewSale(Client $client, string $orders)
    {
        $sale = new Sale();
        $sale->client_id = $client->id;
        $sale->orders = Str::of($orders)->trim(',');

        return $sale;
    }
}
