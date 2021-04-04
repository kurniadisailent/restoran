@extends('admin/layout.master')

@section('title','Pelanggan')
@section('title2','Edit')

@section('konten')

<div class="card">
  <div class="card-header">
    <h4>Tambah Pelanggan</h4>
  </div>
  <div class="card-body">
    <form action="{{route('pelangganaccount.update',['pelangganaccount'=>$data->id_pelanggan])}}}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>*Nama pelanggan</label>
          <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan',$data->nama_pelanggan) }}" class="form-control @error('username') is-invalid @enderror" Required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="username">*Username</label>
          <input id="username" type="text" name="username" value="{{old('username',$data->username)}}" class="form-control @error('username') is-invalid @enderror" Required>  
          @error('email')
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
          <input id="email" type="text" name="email" value="{{old('email',$data->email)}}" class="form-control @error('email') is-invalid @enderror" Required>  
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