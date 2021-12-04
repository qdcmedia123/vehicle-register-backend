<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle = DB::table('vehicles')
        ->join('models', 'vehicles.model_id', '=', 'models.id')
        ->get();
        return $vehicle;
        //return Vehicle::all();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required|min:2|max:150',
            'price' => 'required|numeric|min:1|max:5000000',
            'image_url' => 'required',
            'persons' => 'required|numeric|min:1|max:20',
            'doors' => 'required|numeric|min:1|max:50',
            'liters_per_km' => 'required|numeric|min:1|max:500',
            'licence_number' => 'required|max:25|min:2', 
            'model_id' => 'required|numeric|max:500',
            'production_year' => 'required',
            'mileage' => 'required|numeric|min:1',
            'date_of_registration' => 'required',
            'veteran' => 'in:yes,no',
            'brand' => 'required|numeric|min:1|max:50000',
            
        );
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->errors();
        }

        $vehicle = new Vehicle();
        $vehicle->title = $request->title;
        $vehicle->price = $request->price;
        $vehicle->image_url = $request->image_url;
        $vehicle->doors = $request->doors;
        $vehicle->persons = $request->persons;
        $vehicle->liters_per_km = $request->liters_per_km;
        $vehicle->licence_number = $request->licence_number;
        $vehicle->model_id = $request->model_id;
        $vehicle->production_year = $request->production_year;
        $vehicle->mileage = $request->mileage;
        $vehicle->date_of_registration = $request->date_of_registration;
        $vehicle->veteran = $request->veteran;
        $vehicle->brand = $request->brand;
        
        $vehicle->save();
        
        return $vehicle;
        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'licence_number' => 'required|max:25|min:2', 
            'model_id' => 'required|numeric|max:500',
            'production_year' => 'required',
            'mileage' => 'required|numeric|min:1',
            'date_of_registration' => 'required',
            'veteran' => 'in:yes,no',
            'brand' => 'required|numeric|min:1|max:50000',
            
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return $validator->errors();
        }

        $vehicle = Vehicle::find($id);

        $vehicle->update($request->all());

        return $vehicle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
    }
}
