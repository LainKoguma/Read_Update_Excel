<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>

<form method="post" action="bdatos.php" enctype="multipart/form-data">
        <div class="form-group row">
          <label class="col-md-3">Select File</label>
          <div class="col-md-8">
        
        <input type="file" value="excel" name="uploadfile" id="fileUpload" />
        </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-8">
          	<input type="button" id="upload" value="Upload" onclick="Upload()" />
             
        <input type="submit"  name="submit" class="btn btn-primary">
      </form>       
      </div>
    </div>


<hr />
<div id="dvExcel"></div>




<script type="text/javascript">
    function Upload() {
        //Referencia el Documentos con el Input
        var fileUpload = document.getElementById("fileUpload");
 
 
        //Valida que sea documento de excel
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
 
                
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }
    };
    function ProcessExcel(data) {
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
 
        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];
 
        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);
 
        //Create a HTML Table element.
        var table = document.createElement("table");
        table.border = "1";
 
        //Add the header row.
        var row = table.insertRow(-1);
 
        //Add the header cells.
        var headerCell = document.createElement("TH");
        headerCell.innerHTML = "No";
        row.appendChild(headerCell);
 
        headerCell = document.createElement("TH");
        headerCell.innerHTML = "Project2";
        row.appendChild(headerCell);
 
        headerCell = document.createElement("TH");
        headerCell.innerHTML = "Title";
        row.appendChild(headerCell);

        headerCell = document.createElement("TH");
        headerCell.innerHTML = "Price";
        row.appendChild(headerCell);
 
        //Add the data rows from Excel file.
        for (var i = 0; i < excelRows.length; i++) {
            //Add the data row.
            var row = table.insertRow(-1);
 
            //Add the data cells.
            var cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].No;
 
            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].Project;
 
            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].Title;

            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].price;
        }
 
        var dvExcel = document.getElementById("dvExcel");
        dvExcel.innerHTML = "";
        dvExcel.appendChild(table);


    };
</script>
