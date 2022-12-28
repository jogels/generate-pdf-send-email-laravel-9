<body>
  @include('layouts.header')
  @include('layouts.sidebar')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>History</h1>
      <nav class="noprint">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">History</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if (Session::has('success'))
    <div class="alert alert-success alert-call">
        <p>{{ Session::get('success') }}</p>
    </div>
    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger alert-call">
        <p>{{ Session::get('fail') }}</p>
    </div>
    @endif
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card" id="contentToPrint">
            <div class="card-body">
              <h5 class="card-title">History</h5>
              <div class="table-responsive tabletiming" id="tabletiming">
                <table class="table" id="table">
                  <thead>
                    <tr>
                      <th>Date Time</th>
                      <th>Version Number</th>
                      <th>Bu / Afm</th>
                      <th>PIC</th>
                      <th>background</th>
                      <th>Project Number</th>
                      <th>Gambar</th>
                      <th>File</th>
                      <th style="width: 15%;">Aksi</th>

                    </tr>
                  </thead>
                  <?php $no = 1; ?>
                  <tbody>
                    @foreach(\App\Models\Fbn::orderBy('updated_at','DESC')->get() as $fbn)

                    <tr>
                      <td>{{$fbn->updated_at}}</td>
                      <td>{{$fbn->id}}</td>
                      <td>{{ \App\Models\Buafm::where('id',$fbn->id_buafm)->pluck('nama')->first() }}</td>
                      <td>{{ \App\Models\Pic::where('id',$fbn->id_pic)->pluck('nama')->first() }}</td>
                      <td>{{$fbn->background}}</td>
                      <td>{{$fbn->project_number}}</td>
                      <td>
                        @if($fbn->gambar)
                        <a href="{{asset('images/'.$fbn->gambar)}}" target="_blank"><i class="fa fa-eye"></i> Lihat</a>
                        @else
                        -
                        @endif
                      </td>
                      <td><a href="{{ route('download',$fbn->file) }}"><i class="fa fa-download"></i> Download</a></td>
                      <td> <a href="{{ route('edit-pdf',$fbn->id) }}" class="btn btn-sm btn-outline-success btn-hapuskolom mb-1"><i class="fa fa-edit"></i> Edit</a>
                      <a href="{{ route('kirimEmail2',$fbn->id) }}"  class="btn btn-sm btn-outline-primary btn-email"><i class="fa fa-paper-plane"></i> Kirim Email</a></td>
                        <!-- <button value="{{$fbn->id}}" class="btn btn-sm btn-outline-primary btn-kirim" data-toggle="modal" data-target="#kirim"><i class="fa fa-paper-plane"></i> Kirim Email</button> -->
                      </td>

                    </tr>
                    <?php $no++; ?>
                    @endforeach
                  </tbody>

                </table>
              </div>

            </div>
          </div>

        </div>
      </div>

      <div id="kirim" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5> Kirim Email </h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <form method="POST" action="{{ route('kirimEmail') }}">
              {{ csrf_field() }}

              <div class="modal-body">
                <input type="hidden" class="txtid" name="id">

                <div class="form-group">
                  <label for="usr">Nama:</label>
                  <select class="form-control txt-role" name="nama" required>
                  <option value="" selected disabled>Pilih Nama</option>
                  @foreach(\App\Models\BuAfm::all() as $jk)
                    <option value="{{ $jk->id }}">{{ $jk->nama }}</option>
                    @endforeach
                  </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
              </div>
            </form>
          </div>

        </div>
      </div>






    </section>





  </main><!-- End #main -->
  
  @include('layouts.footer')

  <!-- Import jquery cdn -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <!-- modal dialog bootstrap fixxxx -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#table').DataTable({
        ordering: false
      });


      var id;
    $("#table").on('click', '.btn-kirim', function() {
      id = $(this).val();

    });

    $('#kirim').on('show.bs.modal', function() {
      $(".txtid").val(id);

    });
    });

    $("#table").on('click', '.btn-email', function(e) {
        var conf = confirm('apakah anda yakin ingin mengirimkan email ini ?');
        if (conf == false) {
            e.preventDefault();
        }
    });
  </script>

  

<script>


    (function($) {
        $(".alert-call").fadeOut(2500);
     
    })(jQuery);
</script>


</body>

</html>