<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		//echo "ovoje indexs produkta";
		
		$Products = Product::all();        
        return view('index',compact('Products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$validatedData = $request->validate([
            'name' => 'required|max:255',
			'description' => 'required|max:255',
            'price' => 'required',
        ]);
        $show = Product::create($validatedData);
   
        return redirect('/product')->with('success', 'Product is successfully saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
		        $Product = Product::findOrFail($id);
				return view('edit', compact('Product'));

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
		    $validatedData = $request->validate([
            'name' => 'required|max:255',
			'description' => 'required|max:255',
            'price' => 'required'
        ]);
        Product::whereId($id)->update($validatedData);

        return redirect('/product')->with('success', 'Product Data is successfully updated');

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
		$Product = Product::findOrFail($id);
        $Product->delete();

        return redirect('/product')->with('success', 'Product Data is successfully deleted');

    }
}