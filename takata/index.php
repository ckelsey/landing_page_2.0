<?php
require("../inc/config.php");

include '../inc/template_start.php';
include '../inc/page_head.php';
// $json = json_decode(stripslashes(json_decode($userData)));
// var_dump($json);

?>
<section class="site-section site-section-light site-section-top themed-background-default">
        <div class="container">
            <h1 class="text-center animation-slideDown">Takata Eligibility</h1>
            <h2 class="h3 text-center animation-slideUp">Check your vehicles to see if they are eligible for Takata</h2>
        </div>
</section>
<section class="site-content site-section" style="height:auto;background:#FFF;min-height:400px">
  <div class="container" style="margin-top:15px;">
    <div class="row">
        <form action="#" method="post" class="form-horizontal form-bordered" id="vehicle-form" onsubmit="return false;">
                                        <div class="form-group">
                                            <!-- <label class="col-md-4 control-label" for="example-typeahead">Make</label> -->
                                            <div class="col-md-4">
                                            <select id="makeSelect" name="make" class="select-chosen" data-placeholder="Choose a Make.." style="width: 250px;" onchange="changeMake(this)">
                                                        <option value="Value"></option>
                                            </select>            
                                            </div>
                                            <div class="col-md-4">
                                            <select id="model" name="model" class="select-chosen" data-placeholder="Choose a Model.." style="width: 250px;" multiple>
                                                        <option value="United States">Ford</option>
                                                        <option value="United Kingdom">Chevy</option>
                                                        <option value="Afghanistan">BMW</option>
                                                        <option value="Aland Islands">Audi</option>
                                                        <option value="Albania">Mercedes</option>
                                                        <option value="Algeria">Algeria</option>
                                                        <option value="American Samoa">American Samoa</option>
                                                        <option value="Andorra">Andorra</option>
                                            </select>     
                                            </div>     
                                            <div class="col-md-3">
                                            <select id="year" name="year" class="select-chosen" data-placeholder="Choose an Year.." style="width: 250px;" multiple>
                                                        <option value="United States">Ford</option>
                                                        <option value="United Kingdom">Chevy</option>
                                                        <option value="Afghanistan">BMW</option>
                                                        <option value="Aland Islands">Audi</option>
                                                        <option value="Albania">Mercedes</option>
                                                        <option value="Algeria">Algeria</option>
                                                        <option value="American Samoa">American Samoa</option>
                                                        <option value="Andorra">Andorra</option>
                                            </select>
                                            </div>    
                                            <div class="col-md-1">
                                            <button type="button" class="btn btn-success btn-start" onclick="addClick()">Add</button>    
                                            </div>
                                        </div>
                                     <div class="row mt30" id="resultsdiv">
                                         <div class="col-md-3"></div>
                                         <div class="col-md-5">  
                                            <div class="table-responsive">
                                                    <table id="vehicle-table" class="table table-striped table-vcenter">
                                                        <thead>
                                                            <tr>
                                                                <th class="headFont">Make</th>
                                                                <th class="headFont">Model</th>
                                                                <th class="headFont">Year</th>
                                                                <th class="headFont">Eligible</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                              </div>
                                           </div> 
                                           <div class="col-md-4">

                                                <a href="/clarence/" class="btn btn-success btn-start" style="margin-top:10px;display:none;" id="file">File your claim</a>

                                           </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-12">
                                               <div class="form-group form-actions mt30 text-center">
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="submitSearch()"><i class="fa fa-angle-right"></i> Search</button>
                                                <button type="reset" class="btn btn-sm btn-info" onclick="resetSearch()"><i class="fa fa-repeat"></i> Reset</button>
                                               </div>
                                            </div>
                                        </div>
                                    </form>
    </div>
    <?php
    if(isset($bNoData) && $bNoData) { ?>
      <h3 class="text-primary">Uh-oh! You haven't filed any claims with us yet. Click the 'Find Settlements' button to get started!</h3>
    <?php } else { ?>
      <table id="claims-listing" class="table table-vcenter table-condensed table-hover"></table>
    <?php } ?>
  </div>
</section>

<?php include '../inc/page_footer.php'; ?>
<?php include '../inc/template_scripts.php'; ?>
<script>
     let obj = { data: [] };
    function getVehiclesData() {
  App.postData('https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_admin_dash/incoming_webhook/getAvailVehicles?secret=9e2676d211803aa2014a',null, false, null)
  .then(data => {
        vehiclesData = JSON.parse(data);
        let makeArray = []; let uniqueArray = []; let options = "";
    
        vehiclesData.forEach(element => {
            makeArray.push(element.make);
        });

        uniqueArray = [...new Set(makeArray)]; 
        
        $.each(uniqueArray, function(index, value){
            options += '<option value= "' + value + '">' + value + '</option>';
        }); 
        $('#makeSelect').html(options);
        $("#makeSelect").trigger("chosen:updated");

  }).catch(data => {

  });
}

function changeMake(selectedObj) {
        let modelArray = []; let uniqueModels = []; let yearArray = []; let uniqueYear = [];
        vehiclesData.forEach(element => {
            if(element.make === selectedObj.value) {
                modelArray.push(element.model);
                yearArray.push(element.year);
            }
        });
        uniqueModels = [...new Set(modelArray)];
        uniqueYear = [...new Set(yearArray)];
        let modelOptions = ""; let yearOptions = "";
        $.each(uniqueModels, function(index, value){
            modelOptions += '<option value= "' + value + '">' + value + '</option>';
        }); 
        $.each(uniqueYear, function(index, value){
            yearOptions += '<option value= "' + value + '">' + value + '</option>';
        }); 
        $('#model').html(modelOptions);
        $("#model").trigger("chosen:updated");
        $('#year').html(yearOptions);
        $("#year").trigger("chosen:updated");
}

jQuery(document).ready(function () {
    getVehiclesData();
    App.datatables();
});

function addClick () {
        let make = $('#makeSelect').val();
        let model = $('#model').val();
        let year = $('#year').val();
        let tdStrings = [];
        
        if(model && model.length > 0) {
            model.forEach(element => {
                if(year && year.length > 0) {
                    year.forEach(item => {
                        tdStrings.push("<tr><td>"+make+"</td><td>"+element+"</td><td>"+item+"</td></tr>");
                        obj.data.push({"make":make,"model":element,"year":item});
                    });
                } else {
                    tdStrings.push("<tr><td>"+make+"</td><td>"+element+"</td><td>&nbsp;</td></tr>");
                    obj.data.push({"make":make,"model":element,"year":null});
                }
            });
        } else {
            tdStrings.push("<tr><td>"+make+"</td><td>&nbsp;</td><td>&nbsp;</td></tr>");
            obj.data.push({"make":make,"model":null,"year":null});
        }
        $.each(tdStrings, function(index,value){
                $("#vehicle-table tbody").prepend(value);
        })

        $('#makeSelect').val('').trigger('chosen:updated');
        $('#model').val('').trigger('chosen:updated');
        $('#year').val('').trigger('chosen:updated');

}

function submitSearch() {
    console.log(obj);
    App.postData('https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_claims/incoming_webhook/checkTakataEligibility?secret=f98c8fc1ec4e87fbcf95',JSON.stringify(obj), false, null)
            .then(data => {
                let dataParse = JSON.parse(data);
                console.log(dataParse);
                $("#vehicle-table > tbody").html("");
                if(dataParse.length > 0 || dataParse.length > 0) {
                // $('#results').removeClass('hide');
                let dataSet  = [];
                dataParse.forEach(element => {
                    if(element.eligible){
                        dataSet.push({make:element.make,model:element.model,year:element.year,eligible:"<span class='text-center label label-success'>Yes</span>"});
                        document.getElementById('file').style.display = "inline-block";
                    }
                    else {
                      dataSet.push({make:element.make,model:element.model,year:element.year,eligible:"<span class='text-center label label-default'>No</span>"});
                    }
                    
                });
                if ($.fn.DataTable.isDataTable('#vehicle-table')) {
                    $('#vehicle-table').DataTable().destroy();
                    $('#vehicle-table').empty();
                  }
                $('#vehicle-table').DataTable( {
                    data: dataSet,
                   columnDefs: [
                    {
                        "targets": 3, // your case first column
                        "className": "text-center",
                    }],
                    columns: [
                        { title: "Make", data:"make"},
                        { title: "Model", data:"model" },
                        { title: "Year",data:"year" },
                        { title: "Eligible", data:"eligible" }
                    ]
                } );

                var clientHeight = document.getElementById('resultsdiv').clientHeight;
                var fileHeight = clientHeight/2;
                document.getElementById('file').style.marginTop = fileHeight+"px";

            }

            else {
                alert('No Data Found');
                $('#results-table').empty();
            }
            }).catch(data => {

        });

}
</script>
<?php include '../inc/template_end.php'; ?>