<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // code added by ayaz to Get All Products List

		$products = Product::all();
		return response()->json($products);
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
    public function store(Request $request)
    {
         // code Added by ayaz 
		 
		$validator = Validator::make($request->all(), [
		'text' => 'required'
		]);


		if($validator->fails())
		{
			$response = array('response' => $validator->messages(), 'success'=> false);
			return $response;
		}
		else
		{
			// code added by ayaz to create prooduct POST Request insert data  to DB

			$product = new Product;
			$product->text = $request->input('text');
			$product->body = $request->input('body');
			$product->save();
			return response()->json($product);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //to find data by product id

		$product = Product::find($id);
		return response()->json($product);
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
     * @param  \Illuminate\Http\Request  $requesthttp://localhost:27385/productlistapi/app/Http/Middleware/RedirectIfAuthenticated.php
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		 // code added by ayaz for  update db
		 

		$validator = Validator::make($request->all(), [
		'text' => 'required'
		]);


		if($validator->fails())
		{
			$response = array('response' => $validator->messages(), 'success'=> false);
			return $response;
		}
		else
		{
				// Find  prooduct and update to db

				$product = Product::find($id);
				$product->text = $request->input('text');
				$product->body = $request->input('body');
				$product->save();
				return response()->json($product);
		}





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // code added by ayaz to  Delete product 
		
		$product = Product::find($id);
		$product->delete();
		
		$response = array('response' => 'Item Deleted', 'success'=> true);
			return $response;

    }
}
