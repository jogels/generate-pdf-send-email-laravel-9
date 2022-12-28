<table class="table" id="table">
  <thead>
    <tr>

      <th>Activity</th>
      <th>Timeline</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    @foreach(\App\Models\Timing::where('id_fbn',$id_fbn)->get() as $t)

    <tr>

      <td>{{$t->activity}}</td>
      <td>{{$t->timeline}}</td>
      <td><button value="{{ $t->id }}" type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-hapus ">Delete</button></td>

    </tr>

    @endforeach
  </tbody>

</table>
