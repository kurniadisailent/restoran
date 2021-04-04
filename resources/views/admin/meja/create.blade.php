@extends('admin/layout.master')

@section('title','Meja')
@section('title2','tambah')

@section('konten')

<div class="card">
  <div class="card-header">
    <h4>Tambah Meja</h4>
  </div>
  <div class="card-body">
    <form action="{{route('meja.store')}}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-12">
          <div class="form-group">
            <label>Nomor Meja</label>
            <input  type="text" name="no_meja" value="" class="form-control @error('meja') is-invalid @enderror col-md-4" required>  
            @error('meja')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control col-md-9" name="keterangan" id="" rows="5" required></textarea>
          </div>
          <div class="form-group">
            <label for="kategori-menu">Status</label>
            <select name="status" class="form-control col-md-2" id="kategori-menu1" required>
              <option value="DITEMPATI">DI TEMPATI</option>
              <option value="KOSONG">KOSONG</option>
            </select>
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
