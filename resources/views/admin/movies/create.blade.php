@extends('layouts.base')

@section('title','Create Movies')

@section('content-wrapper')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Movies</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Movies</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="small-box p-2">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="trailer">Trailer</label>
                <input type="text" name="trailer" id="trailer" class="form-control @error('trailer') is-invalid @enderror" value="{{ old('trailer') }}">
                @error('trailer')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie">Movie</label>
                <input type="text" name="movie" id="movie" class="form-control @error('movie') is-invalid @enderror" value="{{ old('movie') }}">
                @error('movie')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}">
                @error('duration')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="date">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date', date('Y-m-d')) }}">
                @error('release_date')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="casts">Casts</label>
                <input type="text" name="casts" id="casts" class="form-control @error('casts') is-invalid @enderror" value="{{ old('casts') }}">
                @error('casts')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="categories">categories</label>
                <input type="text" name="categories" id="categories" class="form-control @error('categories') is-invalid @enderror" value="{{ old('categories') }}">
                @error('categories')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="small_thumbnail">Small Thumbnail</label>
                <input type="file" name="small_thumbnail" id="small_thumbnail" class="form-control @error('small_thumbnail') is-invalid @enderror" accept="image/*">
                @error('small_thumbnail')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="large_thumbnail">large Thumbnail</label>
                <input type="file" name="large_thumbnail" id="large_thumbnail" class="form-control @error('large_thumbnail') is-invalid @enderror" accept="image/*"> 
                @error('large_thumbnail')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="short_about">Short About</label>
                <input type="text" name="short_about" id="short_about" class="form-control @error('short_about') is-invalid @enderror" value="{{ old('short_about') }}">
                @error('short_about')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about" id="about" class="form-control  @error('duration') is-invalid @enderror" rows="6">{{ old('about') }}</textarea>
                @error('duration')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="featured">Featured</label>
                <select name="featured" id="featured" class="form-control @error('featured') is-invalid @enderror">
                    <option value=""></option>
                    <option value="1" {{ old('featured') == "1" ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('featured') == "0" ? 'selected' : '' }}>No</option>
                </select>
                @error('featured')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Submit">
                <input type="reset" class="btn btn-sm btn-danger" value="Reset">
            </div>

        </form>
    </div>
@endsection