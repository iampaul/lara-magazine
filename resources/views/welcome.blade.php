@extends('layouts.app')

@section('content')
<div class="container">
   <section class="magazine_blk" data-animation="bounceIn" data-animation-delay="500">
                  <div class="magazine_page">
                    <div class="container">
                    
                     <div class="heading heading-center">
                    <h2>Our Magazines</h2>
                     <p>Choose magazines you want and subcribe them now to get our services</p>
                   
                </div>
                    
                    
                    
                    
                            <div data-items="3" data-margin="40">
                            
                                   <div class="col-md-4">
                                   <div class="magazine_img ">
                                   <h1>Small Business</h1>
                                   <div class="magazine_image">
                                   <img src="{{ asset('images/service.jpg') }}" alt="image" />
                                   </div>
                                   <a href="#">Subcribe</a>
                                   </div>
                                   </div>

                                   <div class="col-md-4">
                                   <div class="magazine_img ">
                                   <h1>International Services</h1>
                                   <div class="magazine_image">
                                   <img src="{{ asset('images/service.jpg') }}" alt="image" /> 
                                   </div>
                                    <a href="#">Subcribe</a>
                                   </div>
                                   </div>

                                   <div class="col-md-4">
                                   <div class="magazine_img ">
                                   <h1>Financial Services</h1>
                                   <div class="magazine_image">
                                   <img src="{{ asset('images/service.jpg') }}" alt="image" />
                                   </div>
                                    <a href="#">Subcribe</a>
                                   </div>
                                   </div>

                                   <div class="col-md-4">
                                   <div class="magazine_img ">
                                   <h1>Business Consultant</h1>
                                   <div class="magazine_image">
                                   <img src="{{ asset('images/service.jpg') }}" alt="image" />
                                   </div>
                                    <a href="#">Subcribe</a>
                                   </div>
                                   </div>

                                   <div class="col-md-4">
                                   <div class="magazine_img ">
                                   <h1>International consultants</h1>
                                   <div class="magazine_image">
                                   <img src="{{ asset('images/service.jpg') }}" alt="image" /> 
                                   </div>
                                    <a href="#">Subcribe</a>
                                   </div>
                                   </div>

                                   <div class="col-md-4">
                                   <div class="magazine_img ">
                                   <h1>Financial Services</h1>
                                   <div class="magazine_image">
                                   <img src="{{ asset('images/service.jpg') }}" alt="image" /> 
                                   </div>
                                    <a href="#">Subcribe</a>
                                   </div>
                                   </div>
                                 
                                  
                                  
                           </div>
                      </div>       
                    </div>         
                
     

        </section>
</div>
@endsection
