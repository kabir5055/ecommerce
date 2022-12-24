@extends('admin.master')
@section('title')
    Manage User
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Products List</h1>
            <div class="mb-4">
                <a class="btn btn-success btn-sm" href="{{ route('add.product') }}">Add Products</a>
                <h4>{{ session('massage') }}</h4>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('edit.user',['id'=>$user->id]) }}" class="btn btn-primary btn-sm mx-1">Edit</a>

                                    <form action="{{ route('delete.user') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure For Delete This User ??')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection


