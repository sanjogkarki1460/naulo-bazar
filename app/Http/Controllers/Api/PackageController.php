<?php

namespace App\Http\Controllers\Api;

use App\CustomerPackage;



class PackageController extends Controller
{
	
	public function index(){
$customer_packages = CustomerPackage::all();
        return json_encode($customer_packages);
	}
	
	
}
