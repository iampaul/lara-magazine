@extends('layouts.app')
@section('page-css')
<style>
    .StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style> 
@endsection
@section('content')
<div class="container">
<section class="magazine_blk">
<div class="magazine_page">
<div class="container">
<div class="heading heading-center">
<h2>Our Magazines</h2>
<p>Choose your favaourite magazines and subcribe them now</p>
</div>
<div class="row" data-items="3" data-margin="40">

@if(count($magazines) > 0)
@foreach($magazines as $magazine)  
<div class="col-md-4">
  <div class="magazine_img ">
     <h1>{{ $magazine->name }}</h1>     
     <div class="magazine_image">
        <img src="{{ asset('uploads/images/magazines/'.$magazine->image) }}" alt="{{ $magazine->name }}" onerror="this.src='{!! asset('images/no_image/item-no-image.jpg') !!}'" />
     </div>
     <h1>${{ $magazine->price }}</h1>
     <a data-magazine-name="{{ $magazine->name }}" data-magazine-id="{{ $magazine->magazine_id }}" class="subscribe" href="javascript:void(0);">Subscribe</a>
  </div>
</div>
@endforeach
@endif
</div>
</div>
</div>
</section>
</div>


<div class="modal fade" id="subscribe-form-modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form id="subscribe-form" class="" action="{{ url('createSubscription') }}" method="post">
         {{ csrf_field() }}            
            <div class="modal-header text-center">
               <h4 class="modal-title w-100 font-weight-bold"></h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            
            <div class="modal-body mx-3">
              <div class="form-group">
                <label for="card-element">
                  Credit or debit card
                </label>
                <div id="card-element">
                  <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
              </div>            
            </div>

            <div class="modal-footer d-flex justify-content-center">
               <button class="btn btn-success">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection
@section('page-js')
<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">

  $(document).on('click','.subscribe',function(){

      @if(Auth::guard('web')->check())
        openSubscribeModal($(this));
      @else
        window.location = "{!! url('login') !!}";
      @endif

  });

  function openSubscribeModal(that)
  {
      var magazine_name = that.attr('data-magazine-name');
      $("<input>").attr({ 
                 name: "magazine_id", 
                 id: "magazine_id", 
                 type: "hidden", 
                 value: that.attr('data-magazine-id'), 
             }).appendTo("#subscribe-form-modal form");

      var stripe = Stripe('{!! config('services.stripe.key') !!}');
      var elements = stripe.elements();
      var style = {
        base: {
          color: '#32325d',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
            color: '#aab7c4'
          }
        },
        invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
        }
      };
      var card = elements.create('card',{style: style});
      card.mount('#card-element');

      // Handle real-time validation errors from the card Element.
      card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });

      // Handle form submission.
      var form = document.getElementById('subscribe-form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
          } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
          }
        });
      });

      // Submit the form with the token ID.
      function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
      }

      $('#subscribe-form-modal .modal-title').html(magazine_name);
      $('#subscribe-form-modal').modal('show');        
  }
  
</script>
@endsection