@extends('admin/layout.master')

@section('title','Meja')
@section('title2','edit')

@section('konten')

<div class="card">
  <div class="card-header">
    <h4>Edit Meja</h4>
  </div>
  <div class="card-body">
    <form action="{{route('meja.update',['meja'=>$data->id_meja])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-12">
          <div class="form-group">
            <label>Nomor Meja</label>
            <input value="{{ old('no_meja',$data->no_meja) }}" type="text" name="no_meja" value="" class="form-control @error('meja') is-invalid @enderror col-md-4" required>  
            @error('meja')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control col-md-9" name="keterangan" id="" rows="5" required>{{old('keterangan',$data->keterangan)}}</textarea>
          </div>
          <div class="form-group">
            <label for="kategori-menu">Status</label>
            <select name="status" class="form-control col-md-2" id="kategori-menu1" required>
              <option value="KOSONG" @if(old('status',$data->status) == 'KOSONG') selected @endif>KOSONG</option>
              <option value="DITEMPATI" @if(old('status',$data->status) == 'DITEMPATI') selected @endif>DI TEMPATI</option>
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
