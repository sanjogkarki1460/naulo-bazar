<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Market;
use App\Models\Order;
use Illuminate\Http\Request;
use App\User;
use App\Models\Product;
use App\Models\RequestCategory;
use App\productreport\ProductReport;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends BackendController
{
    protected $productReport;

    public function __construct(ProductReport $productReport)
    {
        $this->productReport = $productReport;
    }

    public function index()
    {
	
        try {
            $commission = 0;
            $orders = Order::all();
            // dd(auth()->user()->notifications[0]->data['id']);
            foreach ($orders as $key => $order) {
                $product = Product::find($order->product_id);
                $market = Market::find($product->market_id);
                $commission += $order->total_price * ($market->admin_commission / 100);
            }
            // $categories = RequestCategory::all();
            $total_users = User::count();
            $total_products = Product::count();
            $total_vendors = User::count();
            $total_sales = Order::sum('total_price');
            $from = date("Y", strtotime("-1 month"));
            $to = now();
            $new_users = User::whereBetween('created_at', [$from, $to])->count();
            $new_products = Product::whereBetween('created_at', [$from, $to])->count();
         
            return view($this->_pages . 'dashboard')->with('total_users', $total_users)->with('total_products', $total_products)
                ->with('total_vendors', $total_vendors)->with('total_sales', $total_sales)->with('total_commission', $commission)
                ->with('new_users', $new_users)->with('new_products', $new_products);
        } catch (\Exception $e) {
            dd($e);
            return view('error')->with('error', $e->getMessage());
        }

    }

    public function vendorReport()
    {
        $products = Product::orderBy('stock')->take(15)->get();

        $productStock = $this->productReport->productStock($products);

        //order product
        $orderProducts = Product::with('orders')->take(15)->get();

        $orders = collect([]);

        foreach ($orderProducts as $product) {

            $month = [];
            foreach (range(0, 11) as $r) {
                $month[$r] = 0;
            }

            foreach ($product->orders as $o) {
                $m = (int)Carbon::parse($o->created_at)->format('m');
                $monthIndex = $m - 1;
                $month[$monthIndex] = $month[$monthIndex] + $o->total_price;
            }
            $orders->prepend
            ([
                'name' => $product->title,
                'monthData' => "[" . implode(",", $month) . "]",
                'color' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')',
                'borderColor' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'
            ]);

        }


        return view($this->_mainpages . "vendor-report.index", compact('productStock', 'orders'));
    }

    public function adminReport()
    {
        return view($this->_mainpages . "admin-report.admin");
    }

    public function customerReport()
    {
        // $user = User::get();
        $products = User::get();
        $productStock = collect([]);
        // foreach ($products as $product) {
        //     $orderProducts = Order::where('user_id', $product->id)->count();
        //     $orderCancelled = Order::where('order_status_id', 0)->get();
        //     $productStock->prepend([
        //         'title' => $product->name,
        //         'stock' => $orderProducts,
        //         'order_cancelled' => $orderCancelled,
        //         'color' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'
        //     ]);
        // }

        return view($this->_mainpages . "admin-report.customer", compact('productStock'));
    }

    public function productReport()
    {
        $products = Product::get();
        $productStock = collect([]);
        foreach ($products as $product) {
            $productStock->prepend([
                'title' => $product->title,
                'stock' => $product->stocks->sum('qty'),
                'color' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'
            ]);
        }
        //order product
        $orderProducts = Product::with('orders')->get();
        $orders = collect([]);
        foreach ($orderProducts as $product) {

            $month = [];
            foreach (range(0, 11) as $r) {
                $month[$r] = 0;
            }

            foreach ($product->orders as $o) {
                $m = (int)Carbon::parse($o->created_at)->format('m');
                $monthIndex = $m - 1;
                $month[$monthIndex] = $month[$monthIndex] + $o->total_price;
            }
            $orders->prepend
            ([
                'name' => $product->title,
                'monthData' => "[" . implode(",", $month) . "]",
                'color' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')',
                'borderColor' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'
            ]);

        }


        return view($this->_mainpages . "admin-report.product", compact('productStock', 'orders'));
    }


}
