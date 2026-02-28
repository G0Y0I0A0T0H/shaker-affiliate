@extends('layouts.app')

@section('content')
<h3>Affiliate Dashboard</h3>
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="card"><div class="card-body"><small>Total Orders</small><h4>{{ $stats['total_orders'] }}</h4></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body"><small>Sold Orders</small><h4>{{ $stats['sold_orders'] }}</h4></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body"><small>Total Commissions</small><h4>{{ number_format($stats['total_commissions'],2) }}</h4></div></div></div>
</div>
<div class="alert alert-info">Your referral code: <strong>{{ $affiliate->referral_code }}</strong></div>
<a href="{{ route('affiliate.orders.index') }}" class="btn btn-outline-primary">My Orders</a>
@endsection
