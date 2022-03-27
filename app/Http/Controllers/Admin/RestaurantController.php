<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Restaurantimage;
use DB;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$data['restaurant'] = Restaurant::find($id);
        $data['restaurant'] = DB::table('restaurants')
                        ->join('restaurantimages','restaurantimages.restaurant_id','=','restaurants.id')         
                        ->get();
      //dd($data['restaurant']);
        $data['title'] = "Restaurants";

        return view('admin.Restaurant.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //dd($req);

        $restaurant_image = new Restaurantimage();
        $restaurant_image->image = 'abc.png';

        $restaurant = new Restaurant();
        $restaurant->Rest_Name = "Sai Restaurant";
        $restaurant->Rest_Code = "A1233";
        $restaurant->Rest_Desc = "Sai Restaurant And Hotel 121";
        $restaurant->phone = "9421212733";
        $restaurant->email = "Sai@Restaurant.com";
        $restaurant->save();
        
        $restaurant->Restaurantimage()->save($restaurant_image);


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
        //dd($request);

        if(!$request->has('up_restid'))
        {

            $validated = $request->validate([
            'name' => 'required',
            'Code' => 'required',
            'Description' => 'required',
            'Phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'Image' => 'required|image|mimes:jpeg,png,gif',
        ]);


            
            $file = $request->file('Image');
            $filename = 'restaurant'.time().'.'.$request->Image->extension();
            $destinationPath = public_path('/images/restaurant');
            $file->move($destinationPath, $filename);
            $image = 'images/restaurant/'.$filename; 

            $restaurant_image = new Restaurantimage();
            $restaurant_image->image =$image;

            $restaurant = new Restaurant();
            $restaurant->Rest_Name = $request->name;
            $restaurant->Rest_Code = $request->Code;
            $restaurant->Rest_Desc = $request->Description;
            $restaurant->phone = $request->Phone;
            $restaurant->email = $request->email;
            $restaurant->save();
            
            $restaurant->Restaurantimage()->save($restaurant_image);

            return back();

        }
        else
        {
             $validated = $request->validate([
            'up_restid'=>'required',
            'name' => 'required',
            'Code' => 'required',
            'Description' => 'required',
            'Phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'Image' => 'nullable|image|mimes:jpeg,png,gif',
        ]);


            if($request->hasFile('Image')) 
            {
                $file = $request->file('Image');
                $filename = 'restaurant'.time().'.'.$request->Image->extension();
                $destinationPath = public_path('/images/restaurant');
                $file->move($destinationPath, $filename);
                $image = 'images/restaurant/'.$filename; 

                $restaurant_image = new Restaurantimage();
                $restaurant_image->image =$image;
            }

            // $restaurant = new Restaurant();
            // $restaurant->Rest_Name = $request->name;
            // $restaurant->Rest_Code = $request->Code;
            // $restaurant->Rest_Desc = $request->Description;
            // $restaurant->phone = $request->Phone;
            // $restaurant->email = $request->email;
            // $restaurant->where('id',$request->up_restid)->save();

            Restaurant::where('id', $request->up_restid)->update(array('Rest_Name' => $request->name, 'Rest_Code'=> $request->Code, 'Rest_Desc'=> $request->Description, 'phone'=> $request->Phone, 'email'=> $request->email));

            if($request->hasFile('Image')) 
            {
                Restaurantimage::where('restaurant_id',$request->up_restid)->update(array('image'=>$image));
            
                // $restaurant->Restaurantimage()->update(array('image'=>$image));

            }

            return back();


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
        //
        //echo "Hello"; die();
        // $restaurant = new Restaurant();

        // $dta = $restaurant->where('id',$id)->Restaurantimage()->get();

        //$dta = Restaurant::find($id);
        // DB::table('restaurants')
        //                 ->join('restaurantimages','restaurantimages.restaurant_id','=','restaurants.id')
        //                 ->where('restaurants.id',$id)         
        //                 ->first();
        //Restaurant::find(3)->Restaurantimage;
        //$dta = $restaurant->where('id',2)->menus()->get(); 
        $restaurant_data = DB::table('restaurants')
                        ->join('restaurantimages','restaurantimages.restaurant_id','=','restaurants.id')
                        ->where('restaurants.id',$id)
                        ->select('restaurants.*', 'restaurantimages.image')         
                        ->get();
            //dd($restaurant_data );          

        $restaurant['data'] = $restaurant_data;
       echo json_encode($restaurant);
       exit; 
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
       //   $Product_brand['data'] = $id;
       // echo json_encode($Product_brand);
       // exit; 
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        
        //dd($request);
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
        //dd($id);

        $Restaurant = Restaurant::find($id);
        $Restaurant->delete();

        return back();
    }
}
