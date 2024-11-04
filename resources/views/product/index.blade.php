@extends('layouts.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            {{-- <i class=""></i> --}}
            <a href="{{ route('index.create') }}" class="btn btn-sm btn-primary">Add New Product</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Sell Price</th>
                        <th>Buy Price</th>
                        <th>Image</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Sell Price</th>
                        <th>Buy Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ( $product as $item )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->sell_price }}</td>
                        <td>{{ $item->buy_price }}</td>
                        <td>
                            @empty($item->image)
                            <img
                                src="{{url('image/nophoto.jpg')}}"
                                alt="product-image"
                                class="rounded"
                                style="width: 100%; max-width: 100px; height: auto;">
                            @else
                            <img
                                src="{{url('image')}}/{{$item->image}}"
                                alt="product-image"
                                class="rounded"
                                style="width: 100%; max-width: 100px; height: auto;">
                            @endempty
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-secondary">show</a>
                            <a href="{{ route('index.edit', $item->id) }}" class="btn btn-sm btn-warning">edit</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$item->id}}">
                                delete
                            </button>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Produk</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete {{$item->nama}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            <form action="{{ route('index.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection