<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

  protected $shop;

  /**
   * ShopController constructor.
   * @param $shop
   */
  public function __construct(Shop $shop)
  {
    $this->middleware('auth', ['only' => ['like', 'preferred', 'preferredData', 'dislike']]);
    $this->shop = $shop;
  }


  /**
   * Display a listing of the resource.
   *
   * @param Request $request
   * @return Request
   */
  public function index(Request $request)
  {
    $shops = $this->shop->getList($request->latitude, $request->longitude);
    return response()->json($shops);
  }

  public function like(Request $request){
    $user = Auth::user();
    $user->shops()->toggle([$request->id => ['like' => true]]);
    return response()->json(true);
  }

  public function dislike(Request $request){
    $user = Auth::user();
    $user->shops()->toggle([$request->id => ['like' => false]]);
    return response()->json(true);
  }

  public function preferred(){
    return view('preferred');
  }

  public function preferredData(Request $request){
    $shops = $this->shop->getList($request->latitude, $request->longitude, true);
    return response()->json($shops);
  }
}
