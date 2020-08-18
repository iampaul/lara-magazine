<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Magazine_model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->outputData = array();

    }

    public function index()
    {

        $this->outputData['magazines'] = Magazine_model::where('status','ACTIVE')->orderBy('magazine_id', 'asc')->get();
        return view('home',$this->outputData);
    }

    public function postCreateSubscription(Request $request)
    {
        $input_data = $request->all();

        $magazine_id = $input_data['magazine_id'];
        $magazine    = Magazine_model::findOrFail($magazine_id); 
        
        try {
                $stripe = new \Stripe\StripeClient(
                   config('services.stripe.secret')
                );

                if(empty(Auth::user()->stripe_id))
                {    
                    //Create Customer
                    $customer =  $stripe->customers->create(array(
                        'name' => 'test',    
                        'email' => Auth::user()->email,
                        'source'  => $input_data['stripeToken'],
                        'address' => ["city" => "madurai", "country" => "India", "line1" => "123, test street", "line2" => "", "postal_code" => "625706", "state" => "Tamil Nadu"]
                    ));

                    $customer_id = $customer->id;

                    $profile = User::findOrFail(Auth::user()->id);
                    $profile->stripe_id = $customer_id;
                    $profile->update();
                }
                else
                {
                    $customer_id = Auth::user()->stripe_id;
                }    

                //Create Subscription
                $amount = $magazine->price * 100;
                $subscription = $stripe->subscriptions->create([
                  'customer' => $customer_id,
                  'items' => [[
                    'price_data' => [
                      'unit_amount' => $amount,
                      'currency' => 'usd',
                      'product' => $magazine->stripe_id,
                      'recurring' => [
                        'interval' => $magazine->frequency,
                      ],
                    ],
                  ]],
                ]);

                Toastr::success('Subscription created!','',["timeOut" => 10000]);
                return redirect('mysubscriptions');
        }
        catch (\Stripe\Error\Base $e) {
            Toastr::error('Failed to create subscription','',["timeOut" => 10000]);
            return redirect('mysubscriptions');          
        }   
        catch (Exception $e) 
        {
            Toastr::error('Failed to create subscription','',["timeOut" => 10000]);
            return redirect('mysubscriptions');       
        }
    }

     public function getmysubscriptions()
    {

        $stripe = new \Stripe\StripeClient(
          config('services.stripe.secret')
        );

        $subscriptions = array();
        if(!empty(Auth::user()->stripe_id))
        {
            $subscriptions = $stripe->subscriptions->all(['customer' => Auth::user()->stripe_id]);        
        }    

        $this->outputData['subscriptions'] = $subscriptions;
        return view('mysubscriptions',$this->outputData);
    }
}
