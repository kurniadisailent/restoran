@extends('kasir.layout.master')
@section('title','Kasir')
@section('konten')
@if (session('sukses'))
<div class="alert alert-success alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">
    <span>&times;</span>
  </button>
  <strong>Success!</strong> {{ session('sukses') }}.
</div>
@endif
<div class="card">
  <div class="card-header">
    <h4>Pengaturan Akun</h4>
  </div>
  <div class="card-body">
    <form action="{{route('kasir.pengaturanakun.edit')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row d-flex justify-content-center">
        <div class="col-md-2 mt-4 mb-2">
          <img src="{{url('assets/foto_kasir/'.$data->file_foto_kasir)}}" width="150" class="img-thumbnail mr-3" align="left" id="preview">
          <div class="text-center">
            
          </div>
        </div>
        <div class="col-md-8">
          <label>Masukan Foto Karyawan</label>
          <div class="form-group">
            <div class="custom-file">
              <input name="file_foto_kasir" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" id="inputGambar_kasir" placeholder=" masukan file gambar buku" name="gambar">
              <label class="custom-file-label" for="inputGambar_kasir">Cari Gambar</label>
              <small>150px X 150px</small>
            </div>
          </div>

          <div class="form-group">
            <label>*Nama Karyawan</label>
            <input type="text" name="nama_kasir" value="{{$data->nama_kasir}}" class="form-control" required>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label>*Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect2">
              <option value="Laki-Laki" @if($data->jenis_kelamin) == 'Laki-Laki') selected @endif >Laki-Laki</option>
              <option value="Perempuan" @if($data->jenis_kelamin) == 'Perempuan') selected @endif >Perempuan</option>
            </select>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label>*Alamat</label>
            <textarea type="text" name="alamat" class="form-control" value="" required>{{$data->alamat}}</textarea>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label>*Nomor Hand Phone</label>
            <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" name="no_hp" value="{{$data->no_hp}}" class="form-control" required>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>*Email</label>
            <input type="text" name="email" value="{{$data->email}}" class="form-control" required>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="username">*Username</label>
            <input id="username" type="text" name="username" value="{{$data->username}}" class="form-control @error('username') is-invalid @enderror" required>
            @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>*Password</label>
            <input type="password" name="password" value="" class="form-control">
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

<script>
  $('#inputGambar_kasir').on('change', function() {
    //get the file name
    var fileName = $(this).val();
    var panjangnamafile = fileName.length;
    if (panjangnamafile > 22) {
      hasilpotong = fileName.substring(0, 22);
      $(this).next('.custom-file-label').html(hasilpotong);
    } else {
      $(this).next('.custom-file-label').html(fileName);
    }
  })
</script>
@endsection


@push('js')
<script type="text/javascript">
  function filePreview(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview').attr('src', e.target.result)
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $(function() {
    $("#inputGambar_kasir").change(function() {
      filePreview(this);
    });
  });
</script>
@endpush