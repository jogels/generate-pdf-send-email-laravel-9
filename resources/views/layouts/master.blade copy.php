
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

        <section class="section">
            <div class="row" >
              <div class="col-lg-12">
      
                <div class="card" id="contentToPrint">
                  <div class="card-body">
                    <h5 class="card-title">Field Briefing Notes</h5>
      
                    <!-- General Form Elements -->
                    <form method="POST" action="{{route('exportPdf')}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                      <div class="row mb-3">
                        <label for="version_number" class="col-sm-2 col-form-label">Version Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="version_number" id="version_number">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="date" id="date">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="created_by" class="col-sm-2 col-form-label">Created By</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="created_by" id="created_by">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="project_number" class="col-sm-2 col-form-label">Project Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="project_number" id="project_number">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="end_client" class="col-sm-2 col-form-label">End Client</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="end_client" id="end_client">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="wsbl" class="col-sm-2 col-form-label">WSBL/CS</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="wsbl" id="wsbl">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="field_bu" class="col-sm-2 col-form-label">FIELD BU/FM</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="field_bu" id="field_bu">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="background" class="col-sm-2 col-form-label">BACKGROUND</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" style="height: 100px" name="background" id="background"></textarea>
                        </div>
                      </div>

                      {{-- <div class="row mb-3">
                        <label for="project_specification" class="col-sm-2 col-form-label">PROJECT SPECIFICATION</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" style="height: 100px" name="project_specification" id="project_specification"></textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="methodology" class="col-sm-2 col-form-label">METHODOLOGY</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" style="height: 100px" name="methodology" id="methodology"></textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="sampling" class="col-sm-2 col-form-label">SAMPLING</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" style="height: 100px" name="sampling" id="sampling"></textarea>
                        </div>
                      </div> --}}
                      <h5 class="card-title">TIMING</h5>

                        <input data-html2canvas-ignore="true" type="button" class="btn btn-outline-primary rounded-pill" value="Add More rows" onclick="insRow()">
                        <input data-html2canvas-ignore="true" type="button" class="btn btn-outline-primary rounded-pill" value="Add More columns" onclick="insCol()">
                        <br>
                        <br>
                        <div id="POItablediv" class="table-responsive">
                           <table id="POITable" border="1" >

                               
                                <tr data-html2canvas-ignore="true">
                                    <td >Delete? </td>
                                    <td width="20%"></td>
                                    <td onclick="deleteCol(this)"><input class=" btn btn-outline-danger rounded-pill "  type="button" value="Delete" ></td>
                                </tr>
                                <tr>
                                    <td data-html2canvas-ignore="true"></td>
                                    <td><b> No</b> </td>   
                                    <td><input size=20 type="text" style="font-weight: bold;font-size:14px;" value="HEADER"></td>
                                </tr>
                               
                                <tr>
                                    <td data-html2canvas-ignore="true"><input type="button" class="btn btn-outline-danger rounded-pill" value="Delete" onclick="deleteRow(this)"></td>
                                    <td>1</td>
                                    <td><input size=25 type="text"></td>
                                </tr>
                              
                            </table>
                        </div>
                        <br>


                      <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label" >File Upload</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="file" id="formFile">
                        </div>
                      </div>
                        
            
                    <div class="input-group mb-3">
                      <input type="text" class="form-control"name="wsbl" aria-describedby="basic-addon2">
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

                        <button type="submit" class="btn btn-primary">Generate PDF</button>
                      
                      
                       
                      <!-- <a type="submit"  href="{{ route('generatepdf') }}"> Generate PDF</a> -->
                      <!-- <a type="submit" class="btn btn-primary">Generate PDF</a> -->
      
                    </form><!-- End General Form Elements -->
                 
                  </div>
                </div>
                <div class="mt-5">
                   
                    <button onclick="GeneratePDF();" class="btn btn-primary ">Generate PDF using Javascript</button>
                    <button onclick="Convert_HTML_To_PDF();" class="btn btn-primary ">Convert HTML to PDF</button>
                    </div>
              </div>
        </section>

        <script>var table=document.getElementById('POITable');
    
            /*DELETES ROW*/

           function deleteRow(row){
               var i=row.parentNode.parentNode.rowIndex;
               var len = table.rows.length;
               if(len == 3){
                   alert('Cannot Delete');
                   return;
               }
               table.deleteRow(i);
               for(a=i;a<table.rows.length;a++){
                   table.rows[a].cells[1].innerHTML = a-1;
               }
           }

           /*DELETES COLUMN*/

           function deleteCol(col){
               var i = col.cellIndex;
               var len = table.rows.length;
               var length = table.rows[0].cells.length;
               if(length == 3){
                   alert('Cannot Delete');
                   return;
               }
               for(var a=0; a< len; a++) {
                   table.rows[a].deleteCell(i);    
               }
           }
           
           /*INSERTS ROWS*/

           function insRow(){
               
               var new_row = table.rows[2].cloneNode(true);
               var len = table.rows.length;
               new_row.cells[1].innerHTML = len-1;
               
               var inp1 = new_row.cells[2].getElementsByTagName('input')[0];
               inp1.id += len;                                                                //Id gets incremented by len 
               inp1.value = '';
               table.appendChild( new_row );
           }
           
           /*INSERTS COLUMNS*/

           function insCol(){
               var table=document.getElementById('POITable');
               var rows = document.getElementsByTagName('tr');
               i=0;
               while(r=rows[i++]){
                   var c = r.getElementsByTagName('td');
                   var clone = c[2].cloneNode(true);
                   c[0].parentNode.appendChild(clone);
               }
           }</script>
           


    </main><!-- End #main -->

    @include('layouts.footer')
   
   



</body>

</html>