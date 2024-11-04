@extends('layouts.main')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit Data
            </div>
            <div class="card-body">
                <form action="{{ route('index.update', $id->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('put')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $id->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ $id->type }}">
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sell_price">Sell Price:</label>
                        <input type="text" class="form-control @error('sell_price') is-invalid @enderror" id="sell_price" name="sell_price" value="{{ $id->sell_price }}">
                        @error('sell_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Buy Price:</label>
                        <input type="text" class="form-control @error('buy_price') is-invalid @enderror" id="buy_price" name="buy_price" value="{{ $id->buy_price }}">
                        @error('buy_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea type="text" class="form-control" id="description" name="description">{{ $id->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input type="file" class="form-control" id="image" name="image">

                        {{-- @if(!empty($id->image))
                        <img src="{{url('image')}}/{{$id->image}}" alt="" class="rounded" style="width:100%; max-width:100px; height:auto;">
                        @endif --}}
                        
                        @if(isset($id->image) && !empty($id->image))
                            <img src="{{ url('image/' . $id->image) }}" alt="Foto Produk" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                        @else
                            <img src="{{ url('image/nophoto.jpg') }}" alt="No Foto" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection