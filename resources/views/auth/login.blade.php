@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Affiliate Login</h4>
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">WhatsApp Phone</label>
                        <input class="form-control" name="whatsapp_phone" value="{{ old('whatsapp_phone') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
