@extends('layouts.app')

@section('title', isset($tab) && $tab === 'register' ? 'Create Customer Account' : 'Customer & Atelier Login')

@section('content')
<div class="container" style="padding:60px 0;">
    <div style="max-width:480px; margin:0 auto; background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:40px; box-shadow:var(--shadow-md);">
        
        <!-- Brand Header -->
        <div style="text-align:center; margin-bottom:28px;">
            <div style="width:64px; height:64px; background:var(--primary-light); color:var(--primary); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px; border:1px solid rgba(225,29,72,0.2);">
                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <h1 style="font-size:2rem; font-weight:800; color:var(--secondary); font-family:var(--font-heading);">Vogue &amp; Velvet</h1>
            <p style="color:var(--text-muted); font-size:0.95rem; margin-top:4px;">Access your dress inquiries &amp; personalized haute couture reservations</p>
        </div>

        <!-- Auth Tabs Switcher -->
        @php
            $isRegister = (isset($tab) && $tab === 'register') || old('_tab') === 'register' || $errors->has('name');
        @endphp

        <div style="display:grid; grid-template-columns:1fr 1fr; background:#faf7f2; border:1px solid var(--border); border-radius:30px; padding:4px; margin-bottom:28px;">
            <button type="button" id="tab-login-btn" onclick="switchAuthTab('login')" style="padding:10px; border:none; border-radius:24px; font-weight:700; font-size:0.9rem; cursor:pointer; transition:all 0.2s ease; {{ !$isRegister ? 'background:var(--primary); color:white; box-shadow:var(--shadow-sm);' : 'background:transparent; color:var(--text-muted);' }}">
                Sign In
            </button>
            <button type="button" id="tab-register-btn" onclick="switchAuthTab('register')" style="padding:10px; border:none; border-radius:24px; font-weight:700; font-size:0.9rem; cursor:pointer; transition:all 0.2s ease; {{ $isRegister ? 'background:var(--primary); color:white; box-shadow:var(--shadow-sm);' : 'background:transparent; color:var(--text-muted);' }}">
                Create Account
            </button>
        </div>

        <!-- 1. LOGIN FORM -->
        <div id="login-form-panel" style="{{ !$isRegister ? 'display:block;' : 'display:none;' }}">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="hidden" name="_tab" value="login">

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" value="{{ old('email', 'customer@company.com') }}" class="form-control" required placeholder="sophia@example.com">
                    @error('email') <span style="color:var(--danger); font-size:0.8rem; display:block; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" value="password" class="form-control" required placeholder="••••••••">
                    @error('password') <span style="color:var(--danger); font-size:0.8rem; display:block; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="display:flex; justify-content:space-between; align-items:center;">
                    <label style="display:flex; align-items:center; gap:8px; font-weight:500; font-size:0.875rem; cursor:pointer; color:var(--text-main);">
                        <input type="checkbox" name="remember" value="1" checked> Remember me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; height:48px; font-size:1.05rem; margin-top:8px;">
                    Sign In to Customer Account
                </button>
            </form>

            <!-- Quick Demo Accounts -->
            <div style="background:#faf7f2; border:1px solid var(--border); padding:16px; border-radius:var(--radius-sm); margin-top:28px; font-size:0.85rem;">
                <div style="font-weight:700; color:var(--secondary); margin-bottom:6px; font-family:var(--font-heading); font-size:0.95rem;">Quick Demo Accounts:</div>
                <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
                    <span style="color:var(--text-muted);">Customer:</span>
                    <span style="font-weight:600;">customer@company.com / password</span>
                </div>
                <div style="display:flex; justify-content:space-between;">
                    <span style="color:var(--text-muted);">Admin:</span>
                    <span style="font-weight:600;">admin@company.com / password</span>
                </div>
            </div>
        </div>

        <!-- 2. REGISTER FORM -->
        <div id="register-form-panel" style="{{ $isRegister ? 'display:block;' : 'display:none;' }}">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="hidden" name="_tab" value="register">

                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required placeholder="e.g. Sophia Laurent">
                    @error('name') <span style="color:var(--danger); font-size:0.8rem; display:block; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required placeholder="sophia@example.com">
                    @error('email') <span style="color:var(--danger); font-size:0.8rem; display:block; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number (Optional)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+1 (555) 000-0000">
                    @error('phone') <span style="color:var(--danger); font-size:0.8rem; display:block; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-control" required placeholder="At least 6 characters">
                    @error('password') <span style="color:var(--danger); font-size:0.8rem; display:block; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password *</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Re-enter password">
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; height:48px; font-size:1.05rem; margin-top:8px;">
                    Create Customer Account &rarr;
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function switchAuthTab(tab) {
        var loginPanel = document.getElementById('login-form-panel');
        var registerPanel = document.getElementById('register-form-panel');
        var loginBtn = document.getElementById('tab-login-btn');
        var registerBtn = document.getElementById('tab-register-btn');

        if (tab === 'register') {
            loginPanel.style.display = 'none';
            registerPanel.style.display = 'block';
            registerBtn.style.background = 'var(--primary)';
            registerBtn.style.color = 'white';
            registerBtn.style.boxShadow = 'var(--shadow-sm)';
            loginBtn.style.background = 'transparent';
            loginBtn.style.color = 'var(--text-muted)';
            loginBtn.style.boxShadow = 'none';
        } else {
            registerPanel.style.display = 'none';
            loginPanel.style.display = 'block';
            loginBtn.style.background = 'var(--primary)';
            loginBtn.style.color = 'white';
            loginBtn.style.boxShadow = 'var(--shadow-sm)';
            registerBtn.style.background = 'transparent';
            registerBtn.style.color = 'var(--text-muted)';
            registerBtn.style.boxShadow = 'none';
        }
    }
</script>
@endsection
