@extends('layouts.app')

@section('content')
<h3>Affiliates</h3>
<form method="POST" action="{{ route('admin.affiliates.store') }}" class="card card-body mb-3">
    @csrf
    <div class="row g-2">
        <div class="col"><input class="form-control" name="name" placeholder="Name" required></div>
        <div class="col"><input class="form-control" name="whatsapp_phone" placeholder="WhatsApp" required></div>
        <div class="col"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
        <div class="col"><input class="form-control" type="password" name="password_confirmation" placeholder="Confirm" required></div>
        <div class="col"><input class="form-control" name="commission_rate" placeholder="Commission %" required></div>
        <div class="col"><button class="btn btn-primary">Create</button></div>
    </div>
</form>
<table class="table bg-white">
    <thead><tr><th>Name</th><th>Phone</th><th>Status</th><th>Referral</th><th>Actions</th></tr></thead>
    <tbody>@foreach($affiliates as $a)
        <tr>
            <td>{{ $a->name }}</td><td>{{ $a->whatsapp_phone }}</td><td>{{ $a->status }}</td><td>{{ $a->referral_code }}</td>
            <td class="d-flex gap-1">
                <form method="POST" action="{{ route('admin.affiliates.suspend', $a) }}">@csrf @method('PATCH')<button class="btn btn-warning btn-sm">Suspend</button></form>
                <form method="POST" action="{{ route('admin.affiliates.destroy', $a) }}">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
            </td>
        </tr>
    @endforeach</tbody>
</table>
@endsection
