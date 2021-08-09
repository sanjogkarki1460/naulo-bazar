<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Analytics;
use App\Brand;
use App\Order;
use Exception;
use App\Contact;
use App\Dispute;
use App\Product;
use App\WithDraw;
use App\Negotaible;
use App\ReviewProduct;
use App\WithDrawVendor;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Facades\PayPal;
use App\productreport\ProductReport;
use GuzzleHttp\Exception\ConnectException;
use App\Http\Controllers\BackendController;
use Auth;

class MainController extends BackendController
{
    //
    protected $productReport;

    public function __construct(ProductReport $productReport)
    {
        $this->productReport = $productReport;
    }

    public function index()
    {
        return view('backend.master');
    }

    public function bodyContent()
    {
		
        try {
            //retrieve visitors and pageview data for the current day and the last seven days
            $analyticsMonthly2 = Analytics::fetchTotalVisitorsAndPageViews(Period::months(6));
            $analyticsMonthly = $analyticsMonthly2->sum('visitors');
            $data = [];

            foreach ($analyticsMonthly2 as $day) {
                $data[] = [$day['date']->format('F j, Y'), $day['visitors']];
            }

            $analytics = Analytics::getAnalyticsService();
            //$products = Product::orderBy('stock')->take(15)->get();

            // //retrieve visitors and pageviews since the 6 months ago
            $views = Analytics::fetchVisitorsAndPageViews(Period::months(6));
            $test = Analytics::fetchTopBrowsers(Period::months(6));
		
            $productStock = $this->productReport->fetchTopBrowsers($test);

            $total_visitor_sum = $views->sum('visitors');
            $total_page_sum = $views->sum('pageViews');

            $viewsData = collect([]);

            foreach ($views as $product) {

                $month = [];
                foreach (range(0, 11) as $r) {
                    $month[$r] = 0;
                }
                foreach ($views as $o) {
                    $m = (int)$o['date']->format('m');
                    $monthIndex = $m - 1;
                    $month[$monthIndex] = $month[$monthIndex] + $o['pageViews'];
                }

            }
            $viewsData->prepend
            ([
                'name' => $product['pageTitle'],
                'monthData' => "[" . implode(",", $month) . "]",
                'color' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')',
                'borderColor' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'
            ]);
            //retrieve sessions and pageviews with yearMonth dimension since 1 year ago
            $analyticsData = Analytics::performQuery(
                Period::years(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions, ga:pageviews',
                    'dimensions' => 'ga:yearMonth'
                ]
            );

            // $activeuser = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];

        } catch (ConnectException $e) {
            return redirect()->route('products.index')->with('error', 'Cannot Connect to the Google Analytics');

        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('products.index')->with('error', 'Cannot Connect to the Google Analytics');

        }

        return view($this->_mainpages . 'dashboard.dashboard', compact('viewsData', 'data', 'total_page_sum', 'analyticsMonthly', 'total_visitor_sum', 'productStock'));
    }

    public function dashboard()
    {
        $pendingCount =Order::where('order_status_id', 1)->count();
        $approvedCount =Order::where('order_status_id', 2)->count();
        $receivedCount =Order::where('order_status_id', 3)->count();

        $deliveredCount =Order::where('order_status_id', 4)->count();
        $cancelledCount =Order::where('order_status_id', 5)->count();
        $customer_today = User::whereDate('created_at', date('Y-m-d'))->whereDoesntHave( 'roles', function ( $q ) {
            $q->where( 'name', 'admin' );
            $q->orWhere('name', 'vendor');
        } )->count();
        $customer_week = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->whereDoesntHave( 'roles', function ( $q ) {
            $q->where( 'name', 'admin' );
            $q->orWhere('name', 'vendor');
        } )->count();
        $customer_month = User::whereMonth('created_at', date('m'))->whereDoesntHave( 'roles', function ( $q ) {
            $q->where( 'name', 'admin' );
            $q->orWhere('name', 'vendor');
        } )->count();
        $customer_three_month = User::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->whereDoesntHave( 'roles', function ( $q ) {
            $q->where( 'name', 'admin' );
            $q->orWhere('name', 'vendor');
            } )->count();
        $customers = User::whereDoesntHave( 'roles', function ( $q ) {
            $q->where( 'name', 'admin' );
            $q->orWhere('name', 'vendor');
            } )->count();
        
        $product_today = Product::whereDate('created_at', date('Y-m-d'))->count();
        $product_week = Product::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->count();
        $product_month = Product::whereMonth('created_at', date('m'))->count();
        $product_three_month = Product::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->count();
        $products_count = Product::count();
        
        $vendor_today = User::whereDate('created_at', date('Y-m-d'))->whereHas( 'roles', function ( $q ) {
            $q->where( 'name', 'vendor' );
            } )->count();
        $vendor_week = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->whereHas( 'roles', function ( $q ) {
            $q->where( 'name', 'vendor' );
            } )->count();
        $vendor_month = User::whereMonth('created_at', date('m'))->whereHas( 'roles', function ( $q ) {
            $q->where( 'name', 'vendor' );
            } )->count();
        $vendor_three_month = User::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->whereHas( 'roles', function ( $q ) {
            $q->where( 'name', 'vendor' );
            } )->count();
        $vendor_count = User::whereHas( 'roles', function ( $q ) {
            $q->where( 'name', 'vendor' );
            } )->count();
            
        $order_today = Order::whereDate('created_at', date('Y-m-d'))->count();
        $order_week = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->count();
        $order_month = Order::whereMonth('created_at', date('m'))->count();
        $order_three_month = Order::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->count();
        $order_count = Order::count();
        
        $ordervalue_todays = Order::whereDate('created_at', date('Y-m-d'))->get();
        $totalordervalue_today = 0;
        foreach($ordervalue_todays as $ordervalue_today)
        {
            if($ordervalue_today->orderDetails->count())
            {
                $price = $ordervalue_today->orderDetails->first()->price;
                $qty = $ordervalue_today->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalordervalue_today += $total;
            }
        }
        $ordervalue_weeks = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->get();
        $totalordervalue_week = 0;
        foreach($ordervalue_weeks as $ordervalue_week)
        {
            if($ordervalue_week->orderDetails->count())
            {
                $price = $ordervalue_week->orderDetails->first()->price;
                $qty = $ordervalue_week->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalordervalue_week += $total;
            }
        }
        $ordervalue_months = Order::whereMonth('created_at', date('m'))->get();
        $totalordervalue_month= 0;
        foreach($ordervalue_months as $ordervalue_month)
        {
            if($ordervalue_month->orderDetails->count())
            {
                $price = $ordervalue_month->orderDetails->first()->price;
                $qty = $ordervalue_month->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalordervalue_month += $total;
            }
        }
        
        $ordervalue_three_months = Order::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->get();
        $totalordervalue_three_month = 0;
        foreach($ordervalue_three_months as $ordervalue_three_month)
        {
            if($ordervalue_three_month->orderDetails->count())
            {
                $price = $ordervalue_three_month->orderDetails->first()->price;
                $qty = $ordervalue_three_month->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalordervalue_three_month += $total;
            }

        }
        $ordervalues = Order::all();
        $totalordervalue = 0;
        foreach($ordervalues as $ordervalue)
        {
            if($ordervalue->orderDetails->count())
            {
                $price = $ordervalue->orderDetails->first()->price;
                $qty = $ordervalue->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalordervalue += $total;
            }
        }
        
        $sale_today = Order::whereDate('created_at', date('Y-m-d'))->where('order_status_id', 4)->count();
     
        $sale_week = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->where('order_status_id', 4)->count();
        $sale_month = Order::whereMonth('created_at', date('m'))->where('order_status_id', 4)->count();
        $sale_three_month = Order::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->where('order_status_id', 4)->count();
        $sale_count = Order::where('order_status_id', 4)->count();
        
        $salevalue_todays = Order::whereDate('created_at', date('Y-m-d'))->where('order_status_id', 4)->get();
        $totalsalevalue_today = 0;
        foreach($salevalue_todays as $salevalue_today)
        {
            if($salevalue_today->orderDetails->count())
            {
                $price = $salevalue_today->orderDetails->first()->price;
                $qty = $salevalue_today->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalsalevalue_today += $total;
            }
        }
        $salevalue_weeks = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->where('order_status_id', 4)->get();
        $totalsalevalue_week = 0;
        foreach($salevalue_weeks as $salevalue_week)
        {
            if($salevalue_week->orderDetails->count())
            {
                $price = $salevalue_week->orderDetails->first()->price;
                $qty = $salevalue_week->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalsalevalue_week += $total;
            }
        }
        $salevalue_months = Order::whereMonth('created_at', date('m'))->where('order_status_id', 4)->get();
        $totalsalevalue_month= 0;
        foreach($salevalue_months as $salevalue_month)
        {
            if($salevalue_month->orderDetails->count())
            {
                $price = $salevalue_month->orderDetails->first()->price;
                $qty = $salevalue_month->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalsalevalue_month += $total;
            }
        }
        $salevalue_three_months = Order::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->where('order_status_id', 4)->get();
        $totalsalevalue_three_month = 0;
        foreach($salevalue_three_months as $salevalue_three_month)
        {
            if($salevalue_three_month->orderDetails->count())
            {
                $price = $salevalue_three_month->orderDetails->first()->price;
                $qty = $salevalue_three_month->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalsalevalue_three_month += $total;
            }
        }
        $salevalues = Order::where('order_status_id', 4)->get();
        $totalsalevalue = 0;
        foreach($salevalues as $salevalue)
        {
            if($salevalue->orderDetails->count())
            {
                $price = $salevalue->orderDetails->first()->price;
                $qty = $salevalue->orderDetails->first()->qty;
                $total = $price * $qty;
                $totalsalevalue += $total;
            }
        }
        
        $withdraw_request_today = WithDraw::whereDate('created_at', date('Y-m-d'))->where('status', 1)->count();

        $withdraw_request_week = WithDraw::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->where('status', 1)->count();
        $withdraw_request_month = WithDraw::whereMonth('created_at', date('m'))->where('status', 1)->count();
        $withdraw_request_three_month = WithDraw::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->where('status', 1)->count();
        $withdraw_request = WithDraw::where('status', 1)->count();
        
        $product_review_today = ReviewProduct::whereDate('created_at', date('Y-m-d'))->count();
        $product_review_week = ReviewProduct::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->count();
        $product_review_month = ReviewProduct::whereMonth('created_at', date('m'))->count();
        $product_review_three_month = ReviewProduct::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])->count();
        $product_review = ReviewProduct::count();
        
        $latest_orders = Order::whereHas('orderDetails')->orderBy('id', 'DESC')->take(10)->get();
        
        $latest_messages = Contact::orderBy('id', 'DESC')->take(10)->get();
        
        $latest_negotiables = Negotaible::orderBy('id', 'DESC')->take(10)->get();

        return view($this->_mainpages . 'dashboard.admin-dashboard',compact('customer_today', 'customer_week', 'pendingCount','approvedCount','receivedCount','deliveredCount','cancelledCount','customer_month', 'customer_three_month', 'customers', 'product_today', 'product_week', 'product_month', 'product_three_month', 'products_count', 'vendor_today', 'vendor_week', 'vendor_month', 'vendor_three_month', 'vendor_count', 'order_today', 'order_week', 'order_month', 'order_three_month', 'order_count', 'totalordervalue_today', 'totalordervalue_week', 'totalordervalue_month', 'totalordervalue_three_month', 'totalordervalue', 'sale_today', 'sale_week', 'sale_month', 'sale_three_month', 'sale_count', 'totalsalevalue_today', 'totalsalevalue_week', 'totalsalevalue_month', 'totalsalevalue_three_month', 'totalsalevalue', 'withdraw_request_today', 'withdraw_request_today', 'withdraw_request_week', 'withdraw_request_month', 'withdraw_request_three_month', 'withdraw_request', 'product_review_today', 'product_review_week', 'product_review_month', 'product_review_three_month', 'product_review', 'latest_orders', 'latest_messages', 'latest_negotiables'));
    }

    public function checkout()
    {

        //Setup Payer
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');        //Setup Amount
        $amount = PayPal:: Amount();
        $amount->setCurrency('USD');
        $amount->setTotal(20);         //Setup Transaction
        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Your awesome Product!');         //List redirect URLS
        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('PayPalController@getDone'));
        $redirectUrls->setCancelUrl(action('PayPalController@getCancel'));//And finally set all the prerequisites and create the payment
        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));
        $response = $payment->create($this->_apiContext);
        dd($response);     //Return our payment info to the user
        return $response;
    }

    public function vendorDashboard()
    {

        // $total_price = 4500;
        // $commision = Order::where('vendor_id', auth()->user()->id)
        //     ->where('order_status_id', 3)
        //     ->where('withdraw_status', 0)->get()->sum('admin_commision');
        // $total_withdraw = Order::where('vendor_id', auth()->user()->id)
        //     ->where('order_status_id', 3)
        //     ->where('withdraw_status', 0)->get()->sum('total_price');
        // $total_withdraw = $total_withdraw - $commision;
        // $pendingWithdraw = WithDrawVendor::where('user_id', auth()->user()->id)
        //     ->where('status', 'pending')->get();
        // $views = WithDrawVendor::where('user_id', auth()->user()->id)
        //     ->where('status', 'recieved')->get();

        // $viewsData = collect([]);

        // foreach ($views as $product) {

        //     $month = [];
        //     foreach (range(0, 11) as $r) {
        //         $month[$r] = 0;
        //     }

        //     foreach ($views as $o) {
        //         $m = (int)$o['created_at']->format('m');
        //         $monthIndex = $m - 1;
        //         $month[$monthIndex] = $month[$monthIndex] + $o['total_price'];
        //     }

        // }

        // $viewsData->prepend
        // ([
        //     'name' => $product['created_at'],
        //     'monthData' => "[" . implode(",", $month) . "]",
        //     'color' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')',
        //     'borderColor' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'
        // ]);
        // $order_status = DB::table('order_status')->get();
        // $productStock = collect([]);
        // foreach ($order_status as $data) {
        //     $orderProducts = Order::where('order_status_id', $data->order_status_id)->where('vendor_id', auth()->user()->id)->count();
        //     $orderCancelled = Order::where('order_status_id', 5)->where('vendor_id', auth()->user())->get();
        //     $productStock->prepend([
        //         'title' => $data->title,
        //         'stock' => $orderProducts,
        //         'order_cancelled' => $orderCancelled,
        //         'color' => 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')'
        //     ]);
        // }

        return view($this->_mainpages . 'vendor-dashboard.index');

    }

    public function requestWithdraw(Request $request)
    {

        if ($request->withdraw_price == 0) {
            return redirect()->back()->with('error', 'Withdrawal Amount is 0');
        }
        try {
            $user = User::findOrFail($request->user_id);
            $orders = Order::where('vendor_id', $request->user_id)
                ->where('order_status_id', 3)
                ->where('withdraw_status', 0)->get();
            foreach ($orders as $order) {
                $order->withdraw_status = 1;
                $order->save();
            }
            WithDrawVendor::create([
                'user_id' => $user->id,
                'total_commission' => $request->admin_commission,
                'total_price' => $request->withdraw_price,
                'status' => 'pending'
            ]);
            return redirect()->back()->with('status', 'Successfully requested');
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->back();

    }

    public function cancelWithDraw($id)
    {
        try {
            WithDrawVendor::where('id', $id)->delete();
            return redirect()->back()->with('status', 'Successfully Cancelled');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function order()
    {

    }


}
