<div class="form-select-list">
    <label class="form-label">Nama Baris</label>
    <select class="form-control custom-select-value " name="id_baris" id="id_baris" style="width:100%" required>
        <option value="" disabled selected>Pilih Baris</option>
        @foreach(\App\Models\Baris::where('id_fbn',0)->get() as $b)
        <option value="{{$b->id}}">{{$b->baris}}</option>
        @endforeach
    </select>
</div>
<br>
<div class="form-select-list">
    <label class="form-label">Nama Kolom</label>
    <select class="form-control custom-select-value " name="id_kolom" id="id_kolom" style="width:100%" required>
        <option value="" disabled selected>Pilih Kolom</option>
        @foreach(\App\Models\Kolom::where('id_fbn',0)->get() as $k)
        <option value="{{$k->id}}">{{$k->kolom}}</option>
        @endforeach
    </select>
</div>