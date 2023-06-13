@extends('frontend.master_dashboard')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Accueil</a>
                    <span></span> Caisse
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h3 class="heading-2 mb-10">Caisse</h3>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are products in your cart</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">

    <div class="row">
        <h4 class="mb-30">Détails Facture</h4>
        <form method="post" action="{{ route('checkout.store') }}">
        	@csrf


            <div class="row">
                <div class="form-group col-lg-6">
                    <input type="text" required="" name="shipping_name" value="{{ Auth::user()->name }}" >
                </div>
                <div class="form-group col-lg-6">
                    <input type="email" required="" name="shipping_email" value="{{ Auth::user()->email }}">
                </div>
            </div>



	<div class="row shipping_calculator">
	    <div class="form-group col-lg-6">
	        <div class="custom_select">
	            <select name="region_id" class="form-control">
	                <option value="">Choisir une Région...</option>
	                @foreach($regions as $item)
	                <option value="{{ $item->id }}">{{ $item->region_name }}</option>
	                @endforeach

	            </select>
	        </div>
	    </div>
        <div class="form-group col-lg-6">
      <input required="" type="text" name="shipping_phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>

     <div class="row shipping_calculator">
        <div class="form-group col-lg-6">
            <div class="custom_select">
                <select name="ville_id" class="form-control">



                </select>
            </div>
        </div>
                                <div class="form-group col-lg-6">

      <input required="" type="text" name="post_code" placeholder="Heure de Livraison *">
                                </div>
                            </div>


 <div class="row shipping_calculator">
    <div class="form-group col-lg-6">
        <div class="custom_select">
            <select name="quartier_id" class="form-control">


            </select>
        </div>
    </div>
                                <div class="form-group col-lg-6">
      <input required="" type="text" name="shipping_address" placeholder="Address *" value="{{ Auth::user()->address }}">
                                </div>
                            </div>





                            <div class="form-group mb-30">
        <textarea rows="5" placeholder="Autres informations" name="notes"></textarea>
                            </div>



                    </div>
                </div>


<div class="col-lg-5">
<div class="border p-40 cart-totals ml-30 mb-50">
    <div class="d-flex align-items-end justify-content-between mb-30">
        <h4>Votre Commande</h4>

    </div>
    <div class="divider-2 mb-30"></div>
    <div class="table-responsive order_table checkout">
        <table class="table no-border">
            <tbody>
               @foreach($carts as $item)
                <tr>
                    <td class="image product-thumbnail"><img src="{{ asset($item->options->image) }} " alt="#" style="width:50px; height: 50px;" ></td>
                    <td>
                        <h6 class="w-160 mb-5"><a href="shop-product-full.html" class="text-heading">{{ $item->name }}</a></h6></span>
                        <div class="product-rate-cover">

                         <strong>Couleur: {{ $item->options->color }} </strong> <br>
                         <strong>Mesure: {{ $item->options->format }} </strong> <br>
                         <strong>Taille: {{ $item->options->size }}</strong>

                        </div>
                    </td>
                    <td>
                        <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                    </td>
                    <td>
                        <h4 class="text-brand">{{ $item->price }}</h4>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>




 <table class="table no-border">
        <tbody>

       @if(Session::has('coupon'))

       <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">SousTotal</h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{ $cartTotal }} Fcfa</h4>
                </td>
            </tr>

            <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Coupon </h6>
                </td>
                <td class="cart_total_amount">
                    <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon_name'] }} ( {{ session()->get('coupon')['coupon_discount'] }}% ) </h6>
                </td>
            </tr>

              <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Réduction</h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{ session()->get('coupon')['discount_amount'] }} Fcfa</h4>
                </td>
            </tr>

              <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Grand Total</h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{ session()->get('coupon')['total_amount'] }} Fcfa</h4>
                </td>
            </tr>

       @else


       <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Grand Total </h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{ $cartTotal }} Fcfa</h4>
                </td>
            </tr>




       @endif



        </tbody>
    </table>





    </div>
</div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Paiement</h4>
                        <div class="payment_option">
                            <div class="custome-radio">

                                <input class="form-check-input" required="" type="radio" name="payment_option" value="stripe" id="exampleRadios3" checked="">

                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Stripe</label>
                            </div>
                            <div class="custome-radio">

                                <input class="form-check-input" required="" type="radio" name="payment_option" value="cash" id="exampleRadios4" checked="">

                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash à la Livraison</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" value="card" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">

                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                            </div>
                        </div>
                        <div class="payment-logo d-flex">
            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}" alt="">
            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}" alt="">
            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}" alt="">
            <img src="{{ asset('frontend/assets/imgs/theme/icons/payment-zapper.svg') }}" alt="">
        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Soumettre la commande<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </form>


<script type="text/javascript">

  		$(document).ready(function(){
  			$('select[name="region_id"]').on('change', function(){
  				var region_id = $(this).val();
  				if (region_id) {
  					$.ajax({
  						url: "{{ url('/ville-get/ajax') }}/"+region_id,
  						type: "GET",
  						dataType:"json",
  						success:function(data){
  							$('select[name="quartier_id"]').html('');
  							var d =$('select[name="ville_id"]').empty();
  							$.each(data, function(key, value){
  								$('select[name="ville_id"]').append('<option value="'+ value.id + '">' + value.ville_name + '</option>');
  							});
  						},

  					});
  				} else {
  					alert('danger');
  				}
  			});
  		});


  		// Show quartier Data
  		$(document).ready(function(){
  			$('select[name="ville_id"]').on('change', function(){
  				var ville_id = $(this).val();
  				if (ville_id) {
                    function ville(){
  					$.ajax({
  						url: "{{ url('/quartier-get/ajax') }}/"+ville_id,
  						type: "GET",
  						dataType:"json",
  						success:function(data){
  							$('select[name="quartier_id"]').html('');
  							var d =$('select[name="quartier_id"]').empty();
  							$.each(data, function(key, value){
  								$('select[name="quartier_id"]').append('<option value="'+ value.id + '">' + value.quartier_name + '</option>');
  							});
  						},

  					});
                }
  				} else {
  					alert('danger');
  				}
  			});
  		});

  </script>



@endsection
