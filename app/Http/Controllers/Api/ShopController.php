<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ShopCollection;
use App\Models\Product;
use App\Models\Shop;
use App\User;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        
        return new ShopCollection(Shop::all());
    }

    public function info($slug)
    {
        dd('slug');
        return new ShopCollection(Shop::where('slug', $slug)->get());
    }

    public function shopOfUser($id)
    {
        return new ShopCollection(Shop::where('user_id', $id)->get());
    }

    public function allProducts($slug)
    {
        $shop = Shop::where('slug',$slug)->first();
        return new ProductCollection(Product::where('user_id', $shop->user_id)->latest()->paginate(10));
    }

    public function topSellingProducts($slug)
    {
        $shop = Shop::where('slug',$slug)->first();
        return new ProductCollection(Product::where('user_id', $shop->user_id)->orderBy('num_of_sale', 'desc')->limit(4)->get());
    }

    public function featuredProducts($slug)
    {
        $shop = Shop::where('slug',$slug)->first();
        return new ProductCollection(Product::where(['user_id' => $shop->user_id, 'featured'  => 1])->latest()->get());
    }

    public function newProducts($slug)
    {
        $shop = Shop::where('slug',$slug)->first();
        return new ProductCollection(Product::where('user_id', $shop->user_id)->orderBy('created_at', 'desc')->limit(10)->get());
    }

    public function brands($id)
    {

    }

    public function follow($id)
    {
        $shop = Shop::findOrFail($id);
         $user = User::findOrFail(Auth::user()->id);
      
       if(!$user->hasSubscribed($shop))
       {
            $user->subscribe($shop);
            return response()->json(['status' => True,'message'=>'You have started following ' . $shop->name . ' Shop'],200);
       }
       else
       {
            $user->unsubscribe($shop);
            return response()->json(['status' => False,'message'=>'You have Unfollowed ' . $shop->name .  ' Shop'],200);
        }
    }
	
	public function store(Request $request)
    {
        $this->validate($request,[
'name' => 'required',
'email' => 'required|email',
'password' => 'required',
        ]);
        $user = null;
        if(!Auth::check()){
            if(User::where('email', $request->email)->first() != null){
                return response()->json(['error','Email already exists']);
            }
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_type = "vendor";
                $user->password = Hash::make($request->password);
                $user->save();
            }
        else{
            $user = Auth::user();
            if($user->customer != null){
                $user->customer->delete();
            }
            $user->user_type = "vendor";
            $user->save();
        }

        if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
            $user->email_verified_at = date('Y-m-d H:m:s');
            $user->save();
        }

        $seller = new Seller;
        $seller->user_id = $user->id;
        $seller->save();

        if(Shop::where('user_id', $user->id)->first() == null){
            $shop = new Shop;
            $shop->user_id = $user->id;
            $shop->name = $request->name;
            $shop->address = $request->address;
            $shop->slug = preg_replace('/\s+/', '-', $request->name).'-'.$shop->id;

            if($shop->save()){
                
                return response()->json(['sucess' => 'Your Shop has been created successfully!','shop' => $shop])->redirect()->route('shops.index');
            }
            else{
                $seller->delete();
                $user->user_type == 'customer';
                $user->save();
            }
        }

        return response()->json(['error','Something Went Wrong']);
    }
	

   
}
