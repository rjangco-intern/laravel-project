@extends('settings.app')
@section('title') Products @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> Products</h1>
        </div>
        <a href="{{ route('admin.products.insert') }}" class="btn btn-primary pull-right">Add Product</a>
    </div>
     @if ($message = Session::get('success'))
        <div class="alert alert-dismissible alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     <div class="row">
        <div class="col-md-15">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Category </th>
                                <th> Brand </th>
                                <th> Description </th>
                                <th class="text-center"> Quantity </th>
                                <th class="text-center"> Price(₱)</th>
                                <th class="text-center"> Image </th>
                                <th class="text-center"> Created at </th>
                                <th class="text-center"> Updated at </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> 
                                </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->categories['name']}}</td>
                                        <td>{{ $row->brand }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $row->quantity }}</td>
                                        <td>{{ $row->price }}</td>
                                        <td><img src="{{ asset('storage/products/' .$row->image) }}" ></td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">  
                                                <form action="{{ route('admin.products.edit', $row->id)}}" method="get">
                                                    @csrf
                                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-edit"></i>Edit</button>
                                                </form> &nbsp;&nbsp;&nbsp;
                                                <form action="{{ route('admin.products.delete', $row->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit"><i class="fa fa-fw fa-lg fa-trash"></i>Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
