@extends('layout/layout')
<div class="header">
    <div class="header-search">
        <form action="/products/search" method="GET">
            <div style="display: flex; margin: 5px;">
                <div class="form-group" style="width: 70%">
                    <input type="text" name="searchString" class="form-control" placeholder="Search by name or category"
                           style=" width: 95%; padding: 0px 10px; height: 40px; border-radius: 5px; border: 1px solid #EF3B2D;">
                </div>
                <div>
                    <button type="submit" class="btn btn-search">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="header-menu">
        @if(auth()->check() && (auth()->user()->hasRole('administrator') || auth()->user()->hasRole('manager')))
            <button class="btn btn-add">
                <a href="/products/create"> Add product </a>
            </button>
        @endif
        @if(auth()->check() && auth()->user()->hasRole('administrator'))
            <button class="btn btn-manage">
                <a href="/admin/users"> Manage users </a>
            </button>
        @endif
        @if(auth()->check() && auth()->user()->hasRole('administrator'))
            <button class="btn btn-manage">
                <a href="/admin/roles"> Roles </a>
            </button>
        @endif
        @if(auth()->check() && auth()->user()->hasRole('administrator'))
            <button class="btn btn-manage">
                <a href="/admin/permissions"> Permissions </a>
            </button>
        @endif
        @auth
        <form method="post" action="/logout">
            @csrf
            <button type="submit" class="btn btn-out"> Log out </button>
        </form>
        @endauth
        @guest
            <button class="btn btn-add">
                <a href="/login"> Login </a>
            </button>
        @endguest
    </div>
</div>
@foreach($products as $product)
    <div class="product-box">
        <div>
            <div>
                <p class="product-title"> {{ $product->name }}</p>
            </div>
            <div>
                <p> <span> Category: </span>{{ $product->category->name }}</p>
            </div>
            <div>
                <p> <span> Description: </span> <br> {{ $product->description }}</p>
            </div>
            <div>
                <p> <span> Price: </span> {{ $product->price }} EUR </p>
            </div>
            @if(auth()->check() && (auth()->user()->hasRole('administrator') ||  auth()->user()->hasRole('manager')) )
                <div>
                    <button type="submit" class="btn-small btn-edit">
                        <a href="/products/{{$product->id}}/edit " class="">Edit</a>
                    </button>
                    <form action="/products/{{$product->id}}" method="post" style="display: inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-small btn-delete">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endforeach



