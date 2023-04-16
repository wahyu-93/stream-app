@extends('layouts.base')

@section('title','List Movies')

@section('content-wrapper')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Movies</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Movies</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="small-box p-4">
        <a href="{{ route('movies.create') }}" class="btn btn-primary btn-sm">Add Movies</a>
        <br><br>
        
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        
        <table id="movie" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Categories</th>
                    <th>Casts</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($movies as $key => $movie)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>
                            <img src="{{ Storage::url($movie->small_thumbnail) }}" alt="Gagal Upload" style="height: 150px; width: 250px">
                        </td>
                        <td>{{ $movie->categories }}</td>
                        <td>{{ $movie->casts }}</td>
                        <td>
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" id="delete-formm" >
                                @csrf
                                @method('delete')  

                                <a class="btn btn-success btn-sm" href="{{ route('movies.show', $movie->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td> 
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection

@section('script-js')
    <script>
       $(function () {
            $('#movie').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection