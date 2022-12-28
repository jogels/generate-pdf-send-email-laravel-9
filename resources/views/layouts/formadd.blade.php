@include ('layouts.header')
@include ('layouts.sidebar')
<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/rtd/index">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">ADD SINGLE DATA</h5>
                    <form class="row g-3" method="POST" action="{{url('/rtd/save')}}">
                    @csrf
                     <!-- Multi Columns Form -->
                     <div class="col-md-4">
                      <label for="nomor" class="form-label">Nomor (auto)</label>
                      <input class="form-control" id="nomor" name="nomor" readonly
                      value="{{\App\Models\Modelrtd::pluck('No')->last()+1}}"
                      >
                    </div>

                  <div class="col-md-4">
                    <label for="id_login" class="form-label">ID LOGIN</label>
                    <input class="form-control" id="help_urut" name="help_urut">
                  </div>

                  <div class="col-md-4">
                    <label for="nama_direkening" class="form-label">Nama di Rekening</label>
                    <input type="text" class="form-control" id="beneficiary_name" name="beneficiary_name" >
                  </div>

                  <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" class="form-select" name="status">
                      <option value="Field Force">Field Force</option>
                      <option value="Vendor">Vendor</option>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <label for="id_login_old" class="form-label">ID LOGIN OLD</label>
                    <input type="text" class="form-control" id="help_urut_lama" name="help_urut_lama">
                  </div>

                  <div class="col-md-4">
                    <label for="nama_bank" class="form-label">Nama Bank</label>
                    <select id="nama_bank" class="form-select" name="nama_bank">
                      @foreach ($validasibank as $bank)
                      <option value="{{$bank->bank}}">{{$bank->bank}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label for="kode_area" class="form-label">Kode Area</label>
                    <select id="kode_area" class="form-select" name="kode_area">
                      @foreach ($kodearea as $area)
                      <option value="{{$area->namaarea}}">{{$area->namaarea}}</option>
                          
                      @endforeach
                     
                    </select>
                  </div>
                <div class="col-md-1">
                  <label for="status_kode" class="form-label">Kode Area</label>
                  <input type="text" class="form-control" id="status_kode" name="status_kode">
                </div>
                <div class="col-md-4">
                  <label for="nama_vendor" class="form-label">Nama Vendor</label>
                  <select id="nama_vendor" class="form-select" name="nama_vendor">
                    @foreach ($rtdvendor as $vendor)
                    <option value="{{$vendor->vendor_name}}">{{$vendor->vendor_name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="no_rekening" class="form-label">No. Rekening</label>
                  <input type="text" class="form-control" id="no_rekening" name="no_rekening" >
                </div>

                <div class="col-md-4">
                  <label for="metode" class="form-label">Metode</label>
                  <select id="metode" class="form-select" name="metode">
                    @foreach ($listmetode as $metode)
                      <option value="{{$metode->listmetode}}">{{$metode->listmetode}}</option>
                          
                      @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="id_vendor" class="form-label">ID VENDOR</label>
                  <input type="text" class="form-control" id="id_vendor" name="id_vendor">
                </div>

                <div class="col-md-4">
                  <label for="npwp" class="form-label">NPWP</label>
                  <input type="text" class="form-control" id="npwp" name="npwp">
                </div>

                <div class="col-md-4">
                  <label for="nama_intv" class="form-label">Nama INTV / Interviewer</label>
                  <textarea class="form-control" id="nama_intv" name="nama_intv"></textarea>
                </div>

                <div class="col-md-4">
                  <label for="divisi" class="form-label">Divisi</label>
                  <select id="divisi" class="form-select" name="divisi">
                    @foreach ($divisi as $divi)
                    <option value="{{$divi->devisi}}">{{$divi->devisi}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="col-md-4">
                  <label for="kota_kelahiran" class="form-label">Kota Kelahiran</label>
                  <input type="text" class="form-control" id="kota_kelahiran" name="kota_kelahiran">
                </div>

                
                <div class="col-md-4">
                  <label for="tgl_bergabung" class="form-label">Tgl Bergabung</label>
                  <input type="date" class="form-control" id="tgl_bergabung" name="tgl_bergabung">
                </div>

                <div class="col-md-4">
                  <label for="riwayat_vaksin" class="form-label">Riwayat Vaksin</label>
                  <select id="riwayat_vaksin" class="form-select" name="riwayat_vaksin">
                    @foreach ($stepvaksin as $vaksin)
                    <option value="{{$vaksin->status_vaksin}}">{{$vaksin->status_vaksin}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                  <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" >
                </div>

                <div class="col-md-4">
                  <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                </div>

                <div class="col-md-4">
                  <label for="tidak_vaksin" class="form-label">Alasan Tidak Vaksin</label>
                  <input type="text" class="form-control" id="tidak_vaksin" name="tidak_vaksin" readonly>
                </div>

                <div class="col-md-4">
                  <label for="alamat_rumah" class="form-label">Alamat Rumah</label>
                  <textarea class="form-control" id="alamat_rumah" name="alamat_rumah"></textarea>
                </div>

                <div class="col-md-4">
                  <label for="gender" class="form-label">Gender</label>
                  <select id="gender" class="form-select" name="gender">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="jenis_vaksin" class="form-label">Jenis Vaksin</label>
                  <select id="jenis_vaksin" class="form-select" name="jenis_vaksin">
                    @foreach ($jenisvaksin as $jenvaksin)
                    <option value="{{$jenvaksin->namavaksin}}">{{$jenvaksin->namavaksin}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                  <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap"></textarea>
                </div>

                <div class="col-md-4">
                  <label for="usia" class="form-label">Usia (auto)</label>
                  <input type="text" class="form-control" id="usia" name="usia" readonly>
                </div>
                 
                <div class="col-md-4">
                  <label for="training" class="form-label">Training</label>
                  <select id="training" class="form-select" name="training">
                    @foreach ($jenistraining as $training)
                    <option value="{{$training->jenistraining}}">{{$training->jenistraining}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="kota" class="form-label">Kota</label>
                  <input type="text" class="form-control" id="kota" name="kota">
                </div>

                <div class="col-md-4">
                  <label for="status_active" class="form-label">Status Active</label>
                  <select id="status_active" class="form-select" name="status_active">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="trainer" class="form-label">Trainer</label>
                  <input type="text" class="form-control" id="trainer" name="trainer">
                </div>

                <div class="col-md-4">
                  <label for="provinsi" class="form-label">Provinsi</label>
                  <select id="provinsi" class="form-select" name="provinsi">
                    @foreach ($provinsi as $prov)
                    <option value="{{$prov->prov}}">{{$prov->prov}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="ket_inactive" class="form-label">Ket Inactive</label>
                  <select id="status_inactive" class="form-select" name="status_inactive">
                    @foreach ($inactive as $inactv)
                    <option value="{{$inactv->statusdetailinactive}}">{{$inactv->statusdetailinactive}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="status_tablet" class="form-label">Status Tablet</label>
                  <select id="status_tablet" class="form-select" name="status_tablet">
                    <option>Peminjaman</option>
                    <option>Pengembalian</option>
                  </select>
                </div>

                
                <div class="col-md-4">
                  <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                  <select id="pendidikan_terakhir" class="form-select" name="pendidikan_terakhir">
                    @foreach ($pendidikan as $didikan)
                    <option value="{{$didikan->pendidikan}}">{{$didikan->pendidikan}}</option>
                    @endforeach
                  </select>
                </div>
                 
                <div class="col-md-4">
                  <label for="keluarga_dihubungi" class="form-label">Keluarga Yang Bisa Dihubungi</label>
                  <input type="text" class="form-control" id="keluarga_dihubungi" name="keluarga_dihubungi">
                </div>

                <div class="col-md-4">
                  <label for="kode_asset_tablet" class="form-label">Kode Asset Tablet</label>
                  <input type="text" class="form-control" id="kode_asset_tablet" name="kode_asset_tablet">
                </div>

                <div class="col-md-4">
                  <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                  <select id="status_pernikahan" class="form-select" name="status_pernikahan">
                    @foreach ($statusnikah as $nikah)
                    <option value="{{$nikah->statusnikah}}">{{$nikah->statusnikah}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="telp_alternatif" class="form-label">No Telp Lain Alternatif</label>
                  <input type="text" class="form-control" id="telp_alternatif" name="telp_alternatif" >
                </div>
               
                <div class="col-md-4">
                  <label for="ket_tablet" class="form-label">Ket Tablet</label>
                  <input type="text" class="form-control" id="ket_tablet" name="ket_tablet">
                </div>

                <div class="col-md-4">
                  <label for="no_handphone" class="form-label">No. Handphone</label>
                  <input type="text" class="form-control" id="no_handphone" name="no_handphone">
                </div>
                <div class="col-md-4">
                  <label for="no_whatsapp" class="form-label">No. Whatsapp</label>
                  <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp">
                </div>
                
                
               
               
              
               
                
               
               
              
              
               
               
               
                
                
               
              
             
              
                
               
               
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

                </div>
            </div>

        </div>
    </section>
@include ('layouts.footer')

</body>