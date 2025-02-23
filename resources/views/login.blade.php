@extends('layout/layout-common')

@section('space-work')
<h1>LogIn</h1>
@if($errors->any())
@foreach($errors->all() as $error)
<p style="color:red">{{ $error }}</p>

@endforeach
@endif
@if(Session::has('error'))

<p style="color:green">{{Session::get('error')}} </p>
@endif
<form action="{{ route('userLogin') }}" method="post">
@csrf

<input type="email" name="email" placeholder="Enter Email">
<br><br>
<input type="password" name="password" placeholder="Enter Your Password">
<br><br>

<input type="submit" value="Login">
</form>
<a href="/forget-password">Forget Password</a>
@endsection('space-work')