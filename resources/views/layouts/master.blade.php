<body>
  @include('layouts.header')
  @include('layouts.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>FBN</h1>
      <nav class="noprint">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">FBN</li>
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
              <h5 class="card-title">Field Briefing Notes</h5>

              <!-- General Form Elements -->
              <form method="POST" action="{{route('exportPdf')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label for="version_number" class="col-sm-2 col-form-label">Version Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="version_number" id="version_number" value="{{\App\Models\Fbn::pluck('id')->last()+1 }}" readonly>
                  </div>
                </div>
               
                <div class="row mb-3">
                  <label for="project_number" class="col-sm-2 col-form-label">Project Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="project_number" id="project_number" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="background" class="col-sm-2 col-form-label">BACKGROUND</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="background" id="background" required></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="buafm" class="col-sm-2 col-form-label">BU / AFM</label>
                  <div class="col-sm-10">
                    <select class="form-control txt-role" name="id_buafm" required>
                    <option value="" selected disabled>Pilih Bu/Afm</option>
                      @foreach(\App\Models\BuAfm::all() as $jk)
                      <option value="{{ $jk->id }}">{{ $jk->nama }} ({{$jk->email}})</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="buafm" class="col-sm-2 col-form-label">PIC</label>
                  <div class="col-sm-10">
                    <select class="form-control txt-role" name="id_pic" required>
                    <option value="" selected disabled>Pilih PIC</option>
                      @foreach(\App\Models\Pic::all() as $pc)
                      <option value="{{ $pc->id }}">{{ $pc->nama }} ({{$pc->email}})</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              

             

         



                <h5 class="card-title">TIMING</h5>
                <button type="button" class="btn btn-outline-primary rounded-pill" value="Add More rows" data-bs-toggle="modal" data-bs-target="#tambah">Add Data Timing</button>
                <!-- <button type="button" class="btn btn-outline-primary rounded-pill" value="Add More columns" data-bs-toggle="modal" data-bs-target="#addcolumn">Add More columns</button>
                <button type="button" class="btn btn-outline-primary rounded-pill" value="Add More columns" data-bs-toggle="modal" data-bs-target="#addvalue">Add Value</button> -->

                <br>
                <br>
                <div class="table-responsive tabletiming" id="tabletiming">
                  <table class="table" id="table">
                    <thead>
                      <tr>

                        <th>Activity</th>
                        <th>Timeline</th>
                        <th></th>

                      </tr>
                    </thead>
                    <tbody ">
                      @foreach(\App\Models\Timing::where('id_fbn',0)->get() as $t)

                      <tr>

                        <td>{{$t->activity}}</td>
                        <td>{{$t->timeline}}</td>
                        <td><button value="{{ $t->id }}" type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-hapus ">Delete</button></td>

                      </tr>

                      @endforeach
                    </tbody>

                  </table>
                </div>
                <br>

                <h5 class="card-title">CUSTOM TABLE</h5>
                <button type="button" class="btn btn-outline-primary rounded-pill" value="Add More rows" data-bs-toggle="modal" data-bs-target="#addrow">Add More rows</button>
                <button type="button" class="btn btn-outline-primary rounded-pill" value="Add More columns" data-bs-toggle="modal" data-bs-target="#addcolumn">Add More columns</button>
                <button type="button" class="btn btn-outline-primary rounded-pill btn-add-data" value="Add More columns" data-bs-toggle="modal" data-bs-target="#adddata">Add Data</button>
                <br>
                <br>
                <div class="table-responsive tablecustom">
                  <table class="table table-bordered" id="customTable">
                    <thead>
                      <tr>
                        <th></th>
                        @foreach(\App\Models\Kolom::where('id_fbn',0)->get() as $k)
                        <th>{{ $k->kolom }} <button value="{{ $k->id }}" type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-hapuskolom ">Delete</button></th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @foreach(\App\Models\Baris::where('id_fbn',0)->get() as $b)

                      <tr>

                        <th><button value="{{ $b->id }}" type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-hapusbaris ">Delete</button> {{$b->baris}}</th>
                        @foreach(\App\Models\Kolom::where('id_fbn',0)->get() as $k)
                        @if(\App\Models\Tabel::where('id_baris',$b->id)->where('id_kolom',$k->id)->first())
                        <td>{{\App\Models\Tabel::where('id_baris',$b->id)->where('id_kolom',$k->id)->pluck('nilai')->first()}}</td>
                        @else
                        <td>0</td>
                        @endif
                        @endforeach

                      </tr>

                      @endforeach
                    </tbody>
                    <tfoot>
                      <th>Total</th>
                      @foreach(\App\Models\Kolom::where('id_fbn',0)->get() as $k)
                      <th>{{ \App\Models\Tabel::where('id_kolom',$k->id)->sum('nilai') }} </th>
                      @endforeach

                    </tfoot>

                  </table>
                </div>
                <br>


                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg">
                  </div>
                </div>


                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="wsbl" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button">Add Text</button>
                  </div>
                </div>
                <!-- <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Textarea</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" style="height: 100px"></textarea>
                        </div>
                      </div>
                       -->

                <button type="submit" class="btn btn-primary btn-generate">Submit</button>



                <!-- <a type="submit"  href="{{ route('generatepdf') }}"> Generate PDF</a> -->
                <!-- <a type="submit" class="btn btn-primary">Generate PDF</a> -->

              </form><!-- End General Form Elements -->

            </div>
          </div>
          <!-- <div class="mt-5">
                   
                    <button onclick="GeneratePDF();" class="btn btn-primary ">Generate PDF using Javascript</button>
                    <button onclick="Convert_HTML_To_PDF();" class="btn btn-primary ">Convert HTML to PDF</button>
                    </div> -->
        </div>




        <div id="tambah" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5> Tambah Data Timing </h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

              </div>
              <form method="POST" action="#">
                {{ csrf_field() }}
               
                <div class="modal-body">
              
                  <div class="form-group">
                    <label for="usr">Activity:</label>
                    <input type="text" class="form-control" name="activity" required>
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="usr">Time Line:</label>
                    <input type="date" class="form-control" name="timeline" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary btn-tambah">Tambah</button>
                </div>
              </form>
            </div>

          </div>
        </div>


        <!-- CUSTOM TABLE MODAL -->
        <div id="addcolumn" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5> Tambah Kolom </h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

              </div>
              <form method="POST" action="#">
                {{ csrf_field() }}
               
                <div class="modal-body">
                  <div class="form-group">
                    <label for="usr">Nama Kolom:</label>
                    <input type="text" class="form-control" name="kolom" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary btn-addcolumn">Simpan</button>
                </div>
              </form>
            </div>

          </div>
        </div>

        <div id="addrow" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5> Tambah Baris </h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

              </div>
              <form method="POST" action="#">
                {{ csrf_field() }}
               
                <div class="modal-body">
                  <div class="form-group">
                    <label for="usr">Nama Baris:</label>
                    <input type="text" class="form-control" name="baris" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary btn-addrow">Simpan</button>
                </div>
              </form>
            </div>

          </div>
        </div>

        <div id="adddata" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5> Tambah Nilai Pada Baris dan Kolom </h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

              </div>
              <form method="POST" action="#">
                {{ csrf_field() }}


                <div class="modal-body">

                  <div class="bariskolom">

                  </div>



                  <br>
                  <div class="form-group">
                    <label for="usr">Nilai:</label>
                    <input type="number" class="form-control" name="nilai" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary btn-adddata">Simpan</button>
                </div>
              </form>
            </div>

          </div>
        </div>

    </section>





  </main><!-- End #main -->
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  @include('layouts.footer')

  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    //Tambah Data AJAX

    $(".btn-tambah").click(function(e) {

      $("#tambah").modal('hide');

      e.preventDefault();

      var activity = $("input[name=activity]").val();
      var timeline = $("input[name=timeline]").val();


      var url = 'addtiming';

      $.ajax({
        url: url,
        method: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          activity: activity,
          timeline: timeline,
          id_fbn:0

        },

        //jika succress true
        success: function(response) {
          if (response.success) {
            $("input[name=activity]").val("");
            $("input[name=timeline]").val("");

            alert(response.message) //Message come from controller
            $.ajax({
              type: "get",
              url: 'refresh-timing-detail/',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                //console.log(data);
                $(".tabletiming").html(data);
              }
            });
          } else {
            alert(response.message)
          }
        },

        //jika success false
        error: function(error) {
          console.log(error)
        }
      });

    });

    //Hapus Data AJAX
    $("#table").on('click', '.btn-hapus', function(e) {
      id = $(this).val();
      var conf = confirm('apakah anda yakin ingin menghapus data ini ?');
      if (conf == false) {
        e.preventDefault();
        // $("#edit").modal('hide');
      } else { //TRUE
        // $("#edit").modal('hide');

        var url = 'deletetiming';

        $.ajax({
          url: url,
          method: 'GET',
          data: {
            _token: "{{ csrf_token() }}",
            id: id,

          },
          success: function(response) {
            if (response.success == true) {

              alert(response.message) //Message come from controller
              $.ajax({
                type: "get",
                url: 'refresh-timing-detail/',
                data: {
                  "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                  //console.log(data);
                  $(".tabletiming").html(data);
                }
              });
            } else {
              alert("Error")
            }
          },
          error: function(error) {
            console.log(error)
          }
        });
      }

    });
  </script>



  <!-- CUSTOM TABLE -->
  <script>
    //Tambah ROW

    $(".btn-addrow").click(function(e) {

      // modal dialog
      $("#addrow").modal('hide');

      e.preventDefault();

      var baris = $("input[name=baris]").val();

      var url = 'addRow';

      $.ajax({
        url: url,
        method: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          baris: baris,
          id_fbn:0
        },

        //jika succress true
        success: function(response) {
          if (response.success) {
            $("input[name=baris]").val("");

            alert(response.message) //Message come from controller
            $.ajax({
              type: "get",
              url: 'refresh-custom-table/',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                //console.log(data);
                $(".tablecustom").html(data);
              }
            });
          } else {
            alert(response.message)
          }
        },

        //jika success false
        error: function(error) {
          console.log(error)
        }
      });

    });

    $(".btn-addcolumn").click(function(e) {

      // modal dialog
      $("#addcolumn").modal('hide');

      e.preventDefault();

      var kolom = $("input[name=kolom]").val();

      var url = 'addColumn';

      $.ajax({
        url: url,
        method: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          kolom: kolom,
          id_fbn:0
        },

        //jika succress true
        success: function(response) {
          if (response.success) {
            $("input[name=kolom]").val("");

            alert(response.message) //Message come from controller
            $.ajax({
              type: "get",
              url: 'refresh-custom-table/',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                //console.log(data);
                $(".tablecustom").html(data);
              }
            });
          } else {
            alert(response.message)
          }
        },

        //jika success false
        error: function(error) {
          console.log(error)
        }
      });

    });

    $(".btn-adddata").click(function(e) {

      // modal dialog
      $("#adddata").modal('hide');

      e.preventDefault();

      //select dropdown
      var id_baris = $("#id_baris :selected").val();
      var id_kolom = $("#id_kolom :selected").val();
      //input type
      var nilai = $("input[name=nilai]").val();

      var url = 'addData';

      $.ajax({
        url: url,
        method: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          id_kolom: id_kolom,
          id_baris: id_baris,
          nilai: nilai,
          id_fbn:0
        },

        //jika succress true
        success: function(response) {
          if (response.success) {
            $("input[name=nilai]").val("");

            alert(response.message) //Message come from controller
            $.ajax({
              type: "get",
              url: 'refresh-custom-table/',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                //console.log(data);
                $(".tablecustom").html(data);
              }
            });
          } else {
            alert(response.message)
          }
        },

        //jika success false
        error: function(error) {
          console.log(error)
        }
      });

    });

    //Hapus Data AJAX
    $("#customTable").on('click', '.btn-hapusbaris', function(e) {
      id = $(this).val();
      var conf = confirm('apakah anda yakin ingin menghapus baris ini ?');
      if (conf == false) {
        e.preventDefault();
        // $("#edit").modal('hide');
      } else { //TRUE
        // $("#edit").modal('hide');

        var url = 'deleteRow';

        $.ajax({
          url: url,
          method: 'GET',
          data: {
            _token: "{{ csrf_token() }}",
            id: id,

          },
          success: function(response) {
            if (response.success == true) {

              alert(response.message) //Message come from controller
              $.ajax({
                type: "get",
                url: 'refresh-custom-table/',
                data: {
                  "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                  //console.log(data);
                  $(".tablecustom").html(data);
                }
              });
            } else {
              alert("Error")
            }
          },
          error: function(error) {
            console.log(error)
          }
        });
      }

    });


    $("#customTable").on('click', '.btn-hapuskolom', function(e) {
      id = $(this).val();
      var conf = confirm('apakah anda yakin ingin menghapus kolom ini ?');
      if (conf == false) {
        e.preventDefault();
        // $("#edit").modal('hide');
      } else { //TRUE
        // $("#edit").modal('hide');

        var url = 'deleteColumn';

        $.ajax({
          url: url,
          method: 'GET',
          data: {
            _token: "{{ csrf_token() }}",
            id: id,

          },
          success: function(response) {
            if (response.success == true) {

              alert(response.message) //Message come from controller
              $.ajax({
                type: "get",
                url: 'refresh-custom-table/',
                data: {
                  "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                  //console.log(data);
                  $(".tablecustom").html(data);
                }
              });
            } else {
              alert("Error")
            }
          },
          error: function(error) {
            console.log(error)
          }
        });
      }

    });


    $(".btn-add-data").click(function(e) {

      $.ajax({
        type: "get",
        url: 'refresh-baris-kolom/',
        data: {
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
          //console.log(data);
          $(".bariskolom").html(data);
        }
      });


    });
  </script>


<script>


    (function($) {
        $(".alert-call").fadeOut(2500);
     
    })(jQuery);
</script>


</body>

</html>