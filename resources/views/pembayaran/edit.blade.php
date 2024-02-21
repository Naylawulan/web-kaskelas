@extends('layouts/app')

@section('konten')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

                        <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                            


                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="font-weight-bold">SISWA</label>
                            <select class="form-select col-md-12" name="siswa_id" id="siswa_id">
                                <option class="col-md-12" value="">Select Nama Siswa</option>
                                @foreach ( $data as $siswa)
                                <option class="col-md-12" value="{{ $siswa->id }}"> {{ $siswa->nama }} {{ $siswa->kelas }}</option>

                                @endforeach
                            </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL BAYAR</label>
                                <input type="date" class="form-control" name="tgl_bayar" value="{{ $pembayaran->tgl_bayar}}"placeholder="">

                                <!-- error message untuk title -->
                                @error('tgl_bayar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH BAYAR</label>
                                <input type="text" class="form-control" name="jumlah_bayar" value="{{ $pembayaran->jumlah_bayar }}"placeholder="">

                                <!-- error message untuk title -->
                                @error('jumlah_bayar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>

</body>
</html>
@endsection
