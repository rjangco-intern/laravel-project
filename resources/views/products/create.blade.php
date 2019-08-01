@extends('settings.app')
@section('title') Add Product @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Add Product</h1>
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Add Product</h3>
                <form action="{{ route('admin.products.create') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category <span class="m-l-5 text-danger"> *</span></label>
                            <select id="category_id" class="form-control custom-select mt-15 @error('category_id') is-invalid @enderror" name="category_id">
                                <option value=""> --- Select a Category ---</option>
                                @foreach($categories as $category => $name)
                                    <option value="{{ $category  }}"> {{$name}} </option>
                                @endforeach
                            </select>
                            @error('category_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="brand">Brand <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('brand') is-invalid @enderror" type="text" name="brand" id="brand" value="{{ old('brand') }}"/>
                            @error('brand') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('quantity') is-invalid @enderror" type="text" name="quantity" 
                                    id="quantity" value="{{ old('quantity') }}"/>
                            @error('quantity') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                            <label for="price">Price<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" 
                                    id="price" value="{{ old('price') }}"/>
                            @error('price') {{ $message }} @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Product Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Product</button>
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
