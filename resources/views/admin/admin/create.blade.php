@extends('admin/layout.master')

@section('title','Admin')
@section('title2','Tambah')

@section('konten')

<div class="card">
  <div class="card-header">
    <h4>Tambah Admin</h4>
  </div>
  <div class="card-body">
    <form action="{{route('adminaccount.store')}}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>*Nama Admin</label>
          <input type="text" name="nama_admin" value="" class="form-control" Required>  
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="username">*Username</label>
          <input type="text" id="username" name="username" value="" class="form-control @error('username') is-invalid @enderror" Required>  
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
          <input type="password" name="password" value="" class="form-control" Required>  
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group" >
          <label for="email">*Email</label>
          <input type="text" name="email" id="email" value="" class="form-control @error('email') is-invalid @enderror" Required>
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
