@extends('admin/layout.master')

@section('title','Admin')
@section('title2','Edit')

@section('konten')

<div class="card">
  <div class="card-header">
    <h4>Tambah Admin</h4>
  </div>
  <div class="card-body">
    <form action="{{route('adminaccount.update',['adminaccount'=>$data->id_admin])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>*Nama Admin</label>
          <input type="text" name="nama_admin" value="{{ old('nama_admin',$data->nama_admin) }}" class="form-control @error('username') is-invalid @enderror" Required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="username">*Username</label>
          <input id="username" type="text" name="username" value="{{old('username',$data->username)}}" class="form-control @error('username') is-invalid @enderror" Required>  
          @error('username')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
					@enderror
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>*Password</label>
          <input type="password" name="password" value="" class="form-control">  
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="email">*Email</label>
          <input id="email" type="email" name="email" value="{{old('email',$data->email)}}" class="form-control @error('email') is-invalid @enderror" Required>  
          @error('email')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
					@enderror
        </div>
      </div>

    </div>    
      <div class="card-footer text-right">
        <button class="btn btn-primary mr-1" type="submit">Submit</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary" type="reset">Cancel</a>
      </div>
    </form>
  </div>
</div>

@endsection
