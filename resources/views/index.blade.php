<!-- index.blade.php -->

@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Product Name</td>
                <td>Product Price</td>
                <td>Product Category</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
           	 @foreach($Products as $Product)
                <tr>
                    <td>{{$Product->id}}</td>
                    <td>{{$Product->name}}</td>
                    <td>{{$Product->price}}</td>
                    <td>{{$Product->category->name}}</td>
                    <td><a href="{{ route('product.edit',$Product->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('product.destroy', $Product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection