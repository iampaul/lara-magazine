<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine_model;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\UploadTrait;
use Session;
use Str;

class Magazines extends Controller
{

    use UploadTrait;


    public function __construct()
    {
        $this->outputData = array();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $magazines = Magazine_model::all();
        $this->outputData['magazines'] = $magazines;

        $this->outputData['title'] = "Manage Magazines";   
        return view('admin.magazines.index', $this->outputData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->outputData['title'] = "Add Magazine";   
        return view('admin.magazines.create', $this->outputData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:magazines',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'frequency' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $input_data = $request->all();

        if ($request->has('image')) {

             $image = $request->file('image');
             $name = Str::slug($request->input('name')).'_'.time();
             $folder = '/uploads/images/magazines/';
             $filename = $name. '.' . $image->getClientOriginalExtension();

             $this->uploadOne($image, $folder, 'public', $name);
             $input_data['image'] = $filename;
        }    

        $magazine = Magazine_model::create($input_data);

        //Create a Product in stripe
        $stripe = new \Stripe\StripeClient(
          config('services.stripe.secret')
        );
        
        $product = $stripe->products->create([
          'name' => $magazine->name          
        ]);

        $magazine->stripe_id = $product->id;
        $magazine->save();

        Toastr::success('Magazine created!','',["timeOut" => 10000]);
        return redirect()->route('magazines.edit',$magazine->magazine_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magazine_model  $magazine_model
     * @return \Illuminate\Http\Response
     */
    public function show(Magazine_model $magazine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Magazine_model  $magazine_model
     * @return \Illuminate\Http\Response
     */
    public function edit(Magazine_model $magazine)
    {

        if(Session::Get('active_tab'))
        {
            $this->outputData['active_tab'] = Session::Get('active_tab');
            Session::Forget('active_tab');   
        }
        else
        {
            $this->outputData['active_tab'] = 'general';    
        }

        $this->outputData['magazine'] = $magazine;  
        $this->outputData['title'] = "Edit Magazine";   
        return view('admin.magazines.edit', $this->outputData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magazine_model  $magazine_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magazine_model $magazine)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:magazines,name,'.$magazine->magazine_id.',magazine_id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'frequency' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $input_data = $request->all();

        if ($request->has('image')) {

            if(file_exists(public_path('uploads/images/magazines/'.$magazine->image))){
                unlink(public_path('uploads/images/magazines/'.$magazine->image));
            }

             $image = $request->file('image');
             $name = Str::slug($request->input('name')).'_'.time();
             $folder = '/uploads/images/magazines/';
             $filename = $name. '.' . $image->getClientOriginalExtension();

             $this->uploadOne($image, $folder, 'public', $name);
             $input_data['image'] = $filename;
        }
        
        $magazine->update($input_data);

        //Update stripe Product
        $stripe = new \Stripe\StripeClient(
           config('services.stripe.secret')
        );
        $stripe->products->update(
          $magazine->stripe_id,
          ['name' => $magazine->name]
        );

        Toastr::success('Magazine updated!','',["timeOut" => 10000]);
        return redirect()->route('magazines.edit',$magazine->magazine_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magazine_model  $magazine_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magazine_model $magazine)
    {

        if(!empty($magazine->stripe_id))
        {    
            try {
                $stripe = new \Stripe\StripeClient(
                   config('services.stripe.secret')
                );
                $stripe->products->delete(
                  $magazine->stripe_id,
                  []
                );
            } 
            catch (\Stripe\Error\Base $e) {
                Toastr::error('Unable to delete now','',["timeOut" => 10000]);
                return redirect()->route('magazines.index');          
            }   
            catch (Exception $e) 
            {
                Toastr::error('Unable to delete now','',["timeOut" => 10000]);
                return redirect()->route('magazines.index');       
            }
       }
       
       if(file_exists(public_path('uploads/images/magazines/'.$magazine->image))){
            unlink(public_path('uploads/images/magazines/'.$magazine->image));
        }     

        $magazine->delete();

        Toastr::success('Magazine deleted!','',["timeOut" => 10000]);
        return redirect()->back();   
    }
}
