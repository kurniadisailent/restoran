@extends('admin/layout.master')

@section('title','Menu')
@section('title2','edit')

@section('konten')

<div class="card">
  <div class="card-header">
    <h4>Edit Menu</h4>
    </div>
  <div class="card-body">
    <form action="{{ route('menu.update',['menu'=>$data->id_menu]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row d-flex justify-content-center">
      <div class="col-md-2 mt-4 mb-2">
        <img src="{{url('assets/menus/'.$data->file_gambar_menu)}}" width="150" class="img-thumbnail mr-3" align="left" id="preview">
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
            <input type="text" name="nama_menu" value="{{ old('nama_menu',$data->nama_menu) }}" class="form-control" required>  
          </div>
        </div>
          
        <div class="col-md-5">
          <div class="form-group">
            <label>Harga Menu</label>
            <div class=""><input type="number" min="0" max="1000000000" name="harga_menu" class="form-control" value="{{ old('harga',$data->harga) }}" required></div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label>Diskon</label>
            <div class=""><input type="number" min="0" max="100" name="diskon_menu" class="form-control" value="{{ old('diskon',$data->diskon) }}" required></div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label for="kategori-menu">Pilih Kategori Menu</label>
            <select data-value="{{ $data ? $data->value : old('nama_kategori') }}" name="kategori_menu" class="form-control" id="kategori-menu1" required>
              <option value="Makanan" @if(old('nama_kategori',$data->nama_kategori) == 'Makanan') selected @endif>Makanan</option>
              <option value="Minuman" @if(old('nama_kategori',$data->nama_kategori) == 'Minuman') selected @endif>Minuman</option>
              <option value="Dessert" @if(old('nama_kategori',$data->nama_kategori) == 'Dessert') selected @endif>Dessert</option>
            </select>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="kategori-menu">Deskripsi Menu</label>
            <textarea class="form-control" name="deskripsi_menu" id="" rows="1" required>{{ old('deskripsi',$data->deskripsi) }}</textarea>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>Stok</label>
            <div class=""><input type="number" name="stok" min="0" max="1000000000" class="form-control" value="{{ old('stok',$data->stok) }}" required></div>
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
    $('#inputGambar_menu').on('change',function(){
    //get the file name
      var fileName = $(this).val();
      var panjangnamafile = fileName.length;
      if (panjangnamafile > 22){
        hasilpotong = fileName.substring(0, 22);
        $(this).next('.custom-file-label').html(hasilpotong);
      }else{
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
		reader.onload = function (e) {
			$('#preview').attr('src',e.target.result)
		}
		reader.readAsDataURL(input.files[0]);
	}
}
$(function(){
	$("#inputGambar_menu").change(function () {
		filePreview(this);
	});
});
</script>
@endpush

<script>
 $(function() {
       $("select").each(function (index, element) {
                const val = $(this).data('value');
                if(val !== '') {
                    $(this).val(val);
                }
        });
 })
</script>