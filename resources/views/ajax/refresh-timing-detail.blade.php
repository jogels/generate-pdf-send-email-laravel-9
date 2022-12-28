<table class="table" id="table">
  <thead>
    <tr>

      <th>Activity</th>
      <th>Timeline</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    @foreach(\App\Models\Timing::where('id_fbn',0)->get() as $t)

    <tr>

      <td>{{$t->activity}}</td>
      <td>{{$t->timeline}}</td>
      <td><button value="{{ $t->id }}" type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-hapus ">Delete</button></td>

    </tr>

    @endforeach
  </tbody>

</table>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



  //Hapus Data AJAX
  $("#table").on('click', '.btn-hapus', function(e) {
    id = $(this).val();
    var conf = confirm('apakah anda yakin ingin menghapus data ini ?');
    if (conf == false) {
      e.preventDefault();
      // $("#edit").modal('hide');
    } else {
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
          if (response.success) {

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