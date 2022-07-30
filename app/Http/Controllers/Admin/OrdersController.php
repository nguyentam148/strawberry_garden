<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrdersController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Order();
    }

    public function list()
    {
        $rows = $this->model->query()
            ->with('student')
            ->with('order_item')
            ->simplePaginate(10);

        return view('admin.orders.list', compact('rows'));
    }
}
