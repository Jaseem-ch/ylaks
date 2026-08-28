@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="container" style="padding:80px 0;">
    <div style="max-width:440px; margin:0 auto; background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:40px; box-shadow:var(--shadow-md);">
        
        <div style="text-align:center; margin-bottom:24px;">
            <div style="width:56px; height:56px; background:var(--primary-light); color:var(--primary); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:12px;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h1 style="font-size:1.75rem; font-weight:800; color:var(--secondary);">Admin Access</h1>
            <p style="color:var(--text-muted); font-size:0.9rem; margin-top:4px;">Log in to manage incoming item requests & catalog</p>
        </div>

        <!-- Demo Account Credentials Callout -->
        <div style="background:#eef2ff; border:1px solid #c7d2fe; padding:12px 16px; border-radius:var(--radius-sm); margin-bottom:24px; font-size:0.85rem;">
            <div style="font-weight:700; color:var(--primary); margin-bottom:4px;">Demo Credentials:</div>
            <div><strong>Admin:</strong> admin@company.com / password</div>
            <div><strong>Customer:</strong> customer@company.com / password</div>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" value="{{ old('email', 'admin@company.com') }}" class="form-control" required autofocus placeholder="admin@company.com">
                @error('email') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" value="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label style="display:flex; align-items:center; gap:8px; font-weight:500; font-size:0.9rem; cursor:pointer;">
                    <input type="checkbox" name="remember" value="1"> Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; height:46px; font-size:1rem; margin-top:8px;">
                Log In to Admin Dashboard
            </button>
        </form>
    </div>
</div>
@endsection
