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
    // To run the functions like, preferred, preferredData, and dislike, the user should be authenticated
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

  /**
   * Like a shop
   * Works only for authenticated users
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function like(Request $request){
    $user = Auth::user();
    // toggle like of a shop
    $user->shops()->toggle([$request->id => ['like' => true]]);
    return response()->json(true);
  }

  /**
   * Dislike a shop
   * Works only for authenticated users
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function dislike(Request $request){
    $user = Auth::user();
    // we try to update the pivot to false if it exists (the updated_at column is also updated)
    // If it doesn't exist, we add a new relation
    if(!$user->shops()->updateExistingPivot($request->id, ['like' => false])){
      $user->shops()->attach($request->id, ['like' => false]);
    }
    return response()->json(true);
  }

  /**
   * Return view for preferred shops
   * Works only for authenticated users
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function preferred(){
    return view('preferred');
  }

  /**
   * Function that returns only the preferred shops
   * Works only for authenticated users
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function preferredData(Request $request){
    $shops = $this->shop->getList($request->latitude, $request->longitude, true);
    return response()->json($shops);
  }
}
