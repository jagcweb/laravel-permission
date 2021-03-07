@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Links</div>

                <div class="card-body">
                    @can('access-admin')
                    <p><a href="{{route('admin')}}">Administration</a></p>
                    @else
                    <p><a style="color:gray;">Administration</a></p>
                    @endcan

                    @can('access-myaccount')
                    <p><a href="{{route('myaccount')}}">My Account</a></p>
                    @endcan

                    @can('access-contact')
                    <p><a href="{{route('contact')}}">Contact</a></p>
                    @endcan

                    @can('access-viewusers')
                    <p><a href="{{route('viewusers')}}">View Users</a></p>
                    @endcan

                    @can('access-editusers')
                    <p><a href="{{route('editusers')}}">Edit Users</a></p>
                    @endcan

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
