@extends('settings.app')
@section('title') Edit Product @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Edit Product</h1>
        </div>
    </div>
        @if (session('error'))
        <div class="alert alert-danger">You have entered an invalid input.
        </div>
    @endif
    
        </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Product</h3>
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $product->name) }}"/>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category <span class="m-l-5 text-danger"> *</span></label>
                            <select id="category_id" class="form-control custom-select mt-15 @error('category_id') is-invalid @enderror" name="category_id" value="{{ old('category_id') }}" required>
                                <option value="{{ old('category_id', $product->category_id) }}"> --- Select a Category ---</option>
                                @foreach($categories as $category => $name)
                                    <option value="{{$category}}"> {{ $name }} </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @error('category_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="brand">Brand <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('brand') is-invalid @enderror" type="text" name="brand" id="brand" value="{{ old('brand', $product->brand) }}"/>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @error('brand') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="quantity">Quantity <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('quantity') is-invalid @enderror" type="text" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}"/>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @error('quantity') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="price">Price <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" value="{{ old('price', $product->price) }}"/>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @error('price') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($product->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('image/' .$product->image) }}" id="image" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Product Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" value="{{ old('image', $product->image) }}"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.products.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
