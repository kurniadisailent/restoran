@extends('admin/layout.master')

@section('title','Menu')
@section('title2','tambah')

@section('konten')

<div class="card">
  <div class="card-header">
    <h4>Tambah Menu</h4>
  </div>
  <div class="card-body">
    <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row d-flex justify-content-center">
        <div class="col-md-2 mt-4 mb-2">
          <img src="{{url('assets/menus/noimage.png')}}" width="150" class="img-thumbnail mr-3" align="left" id="preview">
        </div>
        <div class="col-md-8">
          <label>Pilih Gambar Menu</label>
          <div class="form-group">
            <div class="custom-file">
              <input name="file_gambar_menu" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" id="inputGambar_menu" placeholder=" masukan file gambar buku" name="gambar">
              <label class="custom-file-label" for="inputGambar_menu">Cari Gambar</label>
            </div>
          </div>

          <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" value="" class="form-control" required maxLength="17">
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label>Harga Menu</label>
            <div class=""><input type="number" min="0" max="1000000000" name="harga_menu" class="form-control" required></div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label>Diskon</label>
            <div class=""><input type="number" min=0 min="0" max="100" name="diskon_menu" class="form-control" value="0" required></div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label for="kategori-menu">Pilih Kategori Menu</label>
            <select name="kategori_menu" class="form-control" id="kategori-menu1" required>
              <option>Makanan</option>
              <option>Minuman</option>
              <option>Dessert</option>
            </select>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label for="kategori-menu">Deskripsi Menu</label>
            <textarea class="form-control" name="deskripsi_menu" id="" rows="1" required></textarea>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label>Stok</label>
            <div class=""><input type="number" min="0" max="1000000000" name="stok" class="form-control" value="10" required></div>
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
  $('#inputGambar_menu').on('change', function() {
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
    $("#inputGambar_menu").change(function() {
      filePreview(this);
    });
  });
</script>
@endpush