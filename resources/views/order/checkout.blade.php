@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                    
                    <form action="checkout" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="0">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection