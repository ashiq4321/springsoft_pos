<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\warehouse\WarehouseModel;
use App\Category;
use App\Brand;
use App\Stock_Count;

class StockcountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $brand = Brand::all();
         $warehouse = WarehouseModel::all();
         $categories = Category::all();
        return view('admin/stock_count/stock_count',['categories' => $categories,'warehouse' => $warehouse,'brand' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addStockCount(Request $request)
    {
//      $data = $request->all();
//    $x = NULL;
//    foreach($request->category_id as $key => $value) {
//      $x .= $value .", ";
//    }
//    $data['category_id'] = $x;
//    $y = NULL;
//    foreach($request->brand_id as $key => $v) {
//      $y .= $v .", ";
//    }
//    $data['brand_id'] = $y;
    $name = $request->user()->name;
        $id = $request->user()->id;
        $reference_id = "r-id: " . $id . $name;
        $data = $request->all();
          $data['user_id'] = $id;
         $data['reference_no'] = $reference_id;
        $data['category_id'] = implode(', ', $request->category_id);
        $data['brand_id'] = implode(', ', $request->brand_id);
       
      
    Stock_Count::create($data);
//    echo $y;
    return $data;
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
          //$all_asset = AssetType::latest()->first();
        //return $all_asset;
        $stock_Count = Stock_Count::all();
        //echo $all_expense;
        //return $all_expense;
        return response()->json([
            'data' => $stock_Count,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
