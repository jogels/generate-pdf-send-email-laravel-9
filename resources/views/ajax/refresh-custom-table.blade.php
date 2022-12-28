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

    </tfoot>˝

</table>

<script>
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
</script>