<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Contoh Hasil Cetak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-size: 14px;
        background-image: linear-gradient(315deg, #9fa4c4 0%, #9e768f 74%);
        font-family: sans-serif;
        background-size: cover;
    }

    h1 {
        font-size: 22px;
    }

    table.myTable {
        padding: 0;
        /*replaces table attribute cellpadding */
        border-collapse: collapse;
        /*replaces table attribute cellspacing*/
        border-style: solid;
        /*replaces table attribute border */
        border-width: 1px;
        border-color: black;

    }

    /* for any td in the myTable class */
    table.myTable td {
        text-align: left;
        /*replaces td attribute align */
        border: 1px solid grey;
    }
</style>

<body>
    <?php
    
    $fbn = \App\Models\Fbn::where('id',$id_fbn)->first();

    ?>


    <div class="navbar navbar-expand-lg navbar-light bg-light print-hide">
        <a class="navbar-brand" href="#">FBN</a>

    </div>
    <div class="container mt-3">
        <h1>Field Briefing Notes</h1>
        <div class="content">
            <table class="table">
                <tr>
                    <td>Version Number</td>
                    <td> : </td>
                    <td>{{  $fbn->id }}</td>
                </tr>
                <tr>
                    <td>Project Number</td>
                    <td> : </td>
                    <td>{{  $fbn->project_number }}</td>
                </tr>
                <tr>
                    <td>Background</td>
                    <td> : </td>
                    <td>{{ $fbn->background }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <h1>Timing</h1>
        <div class="table-responsive">
            <table class="myTable" width="100%">
                <thead>
                    <tr>

                        <th>Activity</th>
                        <th>Timeline</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Timing::where('id_fbn',$fbn->id)->get() as $t)

                    <tr>

                        <td>{{$t->activity}}</td>
                        <td>{{$t->timeline}}</td>

                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>
        <br>
        <h1>Custom Table</h1>
        <table class="myTable" width="100%">
            <thead>
                <tr style="background-color: lightskyblue;">
                    <th width="10%"></th>
                    @foreach(\App\Models\Kolom::where('id_fbn',$fbn->id)->get() as $k)
                    <th>{{ $k->kolom }} </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Baris::where('id_fbn',$fbn->id)->get() as $b)

                <tr>

                    <th> {{$b->baris}}</th>
                    @foreach(\App\Models\Kolom::where('id_fbn',$fbn->id)->get() as $k)
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
                <tr style="background-color: lightskyblue;">
                    <th>Total</th>
                    @foreach(\App\Models\Kolom::where('id_fbn',$fbn->id)->get() as $k)
                    <th>{{ \App\Models\Tabel::where('id_kolom',$k->id)->sum('nilai') }} </th>
                    @endforeach
                </tr>


            </tfoot>

        </table>
        <br>
        @if($fbn->gambar)
      
        <!-- <img src="{{ public_path('images/'.$fbn->gambar) }}" alt="" style="width: 100%; height: auto;"> -->
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/'.$fbn->gambar))) }}" alt="" style="width: 100%; height: auto;">
        @endif
       

    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>