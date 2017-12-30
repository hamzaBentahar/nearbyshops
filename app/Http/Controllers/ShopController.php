<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{

  protected $shop;

  /**
   * ShopController constructor.
   * @param $shop
   */
  public function __construct(Shop $shop)
  {
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
    $shops = $this->shop->getList();
    // Add the distance between the shop and the user for every shop
    $shops->map(function ($shop) use ($request) {
      $shop->distance = $this->distance(['lat' => $request->latitude, 'long' => $request->longitude], ['lat' => $shop->latitude, 'long' => $shop->longitude]);
    });
    return response()->json($shops);
  }

  /**
   * Compute the radian
   * @param $x
   * @return float|int
   */
  protected function radian($x)
  {
    return $x * pi() / 180;
  }

  /**
   * Formula to compute the distance between 2 points
   * @param $p1
   * @param $p2
   * @return float|int
   */
  protected function distance($p1, $p2)
  {
    $earthRadius = 6378137;
    $dLat = $this->radian($p2['lat'] - $p1['lat']);
    $dLong = $this->radian($p2['long'] - $p1['long']);
    $dist = sin($dLat / 2) * sin($dLat / 2) + cos($this->radian($p1['lat'])) * cos($this->radian($p2['lat'])) * sin($dLong / 2) * sin($dLong / 2);
    $dist = 2 * atan2(sqrt($dist), sqrt(1 - $dist));
    return $earthRadius * $dist * 0.001;
  }
}
