@extends('layouts.main')

@section('styles')
   
@stop

@section('content')

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalfrm">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="info@noblemanschool.com.sg">
    <input type="hidden" name="item_name" value="Registration Fee">
    <input type="hidden" name="amount" value="{{ $coursefee }}">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="currency_code" value="SGD">
    <input type="hidden" name="return" value="http://noblemanweb.stag-innov8te.com/addmorecourse/paypalsuccess?{{ $stddata }}">
    <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." id="paybut">
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1" id="paybut">
</form>


@stop

@section ('scripts')
    {{ HTML::script('assets/js/jquery.min.js') }}

    <script>
        $(document).ready(function(){
            document.getElementById('paypalfrm').submit();
        });
    </script>
@stop