<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Headquarter;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class CarsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['execpt' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();


        return view('cars/index', ['cars' => $cars]);

        // return view('cars/index')->with('cars', Car::paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $car = new Car;
        // $car->name = $request->input('name');
        // $car->founded = $request->input('founded');
        // $car->description = $request->input('description');
        // $car->save();

        //INSTEAD OF CREATE METHOD WE CAN USE MAKE METHOD BECAUSE CREATE STORE
        //DATA AS SOON AS IT IS CALLED BUT MAKE METHOD DONT S0 THEN
        //WE HAVE TO USE SAVE METHOD AS WELL

        $request->validate([
            'name' => 'required|unique:cars',
            'founded' => 'required|integer|min:0|max:2021',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048'
        ]);

        $newImageName = time() . '_' . $request->name . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        $car = Car::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        $hq = Headquarter::find($id);

        $products = Product::find($id);

        //print_r($products);
        // var_dump($hq);

        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return view('cars.edit')->with('car', $car);
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
        $car = Car::where('id', $id)->update([

            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description')

        ]);
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('/cars');
    }
}
