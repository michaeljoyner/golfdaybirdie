<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessages\Flasher;
use App\Orders\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::where('is_archived', 0)->with('orderItems')->latest()->paginate(5);
        $isArchives = false;
        return view('admin.orders.index')->with(compact('orders', 'isArchives'));
    }

    public function indexArchived()
    {
        $orders = Order::where('is_archived', 1)->with('orderItems')->latest()->paginate(5);
        $isArchives = true;
        return view('admin.orders.index')->with(compact('orders', 'isArchives'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);

        return view('admin.orders.show')->with(compact('order'));
    }

    public function archive($id)
    {
        $order = Order::findOrFail($id);
        $archived = $order->toggleArchivedStatus();

        $this->flasher->success($archived ? 'Order archived' : 'Order unarchived', 'Good job!');

        return redirect('admin/orders/'.$order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        $this->flasher->success('Order deleted', 'Gone with the wind');

        return redirect('admin/orders');
    }
}
