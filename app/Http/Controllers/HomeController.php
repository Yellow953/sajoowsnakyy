<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\OperatingHour;
use App\Models\Product;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function menu()
    {
        $categories = Category::select('id', 'name', 'image')->with('products')->get();
        $products = Product::select('id', 'name', 'price', 'description', 'image', 'category_id')->with('category')->get()->groupBy('category_id');
        $operating_hours = OperatingHour::all();
        $rate = Currency::where('code', 'LBP')->first()->rate;

        $data = compact('categories', 'products', 'operating_hours', 'rate');
        return view('menu.index', $data);
    }

    public function checkout()
    {
        $rate = Currency::where('code', 'LBP')->first()->rate;

        $data = compact('rate');
        return view('menu.checkout', $data);
    }

    public function qrcode_download()
    {
        $url = route('menu');
        $filePath = public_path('qrcodes/qr-code.png');

        QrCode::size(300)->format('png')->generate($url, $filePath);

        return response()->download($filePath);
    }
}
