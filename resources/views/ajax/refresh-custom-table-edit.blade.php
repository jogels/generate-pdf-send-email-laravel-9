<table class="table table-bordered" id="customTable">
    <thead>
        <tr>
            <th></th>
            @foreach(\App\Models\Kolom::where('id_fbn',$id_fbn)->get() as $k)
            <th>{{ $k->kolom }} <button value="{{ $k->id }}" type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-hapuskolom ">Delete</button></th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Models\Baris::where('id_fbn',$id_fbn)->get() as $b)

        <tr>

            <th><button value="{{ $b->id }}" type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-hapusbaris ">Delete</button> {{$b->baris}}</th>
            @foreach(\App\Models\Kolom::where('id_fbn',$id_fbn)->get() as $k)
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
        @foreach(\App\Models\Kolom::where('id_fbn',$id_fbn)->get() as $k)
        <th>{{ \App\Models\Tabel::where('id_kolom',$k->id)->sum('nilai') }} </th>
        @endforeach

    </tfoot>˝

</table>
