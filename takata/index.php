<?php
require("../inc/config.php");

include '../inc/template_start.php';
include '../inc/page_head.php';
// $json = json_decode(stripslashes(json_decode($userData)));
// var_dump($json);
$queryStr = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
$email = isset($queryStr) ? base64_decode($queryStr) : '';
$log = isset($sessionActive);
?>
<!-- <section class="site-section site-section-light site-section-top themed-background-default">
        <div class="container">
            <h1 class="text-center animation-slideDown">Settlement Eligibility</h1>
            <h2 class="h3 text-center animation-slideUp">Check to see if your vehicles are eligible for class action settlements!</h2>
        </div>
</section> -->
<section class="site-content site-section" style="height:auto;background:#FFF;min-height:600px">
  <div class="container" style="margin-top:35px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <img src="../img/AutoClarenceWeb.png" class="img-responsive center-img"/> <br/>
        <p class="text-center animation-slideUp nunito" id="header-text">Check to see if your vehicles are eligible for class action settlements!</p></div>
        <div class="col-md-2"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <span class="ml-2"><b>VIN Entry</b> <label class="switch switch-primary"><input type="checkbox" checked id="searchType"><span></span></label> <b>Make/Model/Year</b></span>
            </div>
        </div>
    </div>
    <div class="row mt30">
        <form action="#" method="post" class="form-horizontal form-bordered" id="vehicle-form" onsubmit="return false;">
                                        <div class="form-group">
                                            <!-- <label class="col-md-4 control-label" for="example-typeahead">Make</label> -->
                                            <div class="col-md-4">
                                            <select id="makeSelect" name="make" class="select-chosen" data-placeholder="Choose a Make.." style="width: 250px;" onchange="changeMake(this)">
                                                        <option value="Value">Choose a Make</option>
                                            </select>            
                                            </div>
                                            <div class="col-md-4">
                                            <select id="model" name="model" class="select-chosen" data-placeholder="Choose a Model.." style="width: 250px;" multiple>
                                                        
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
                                            <button type="button" class="btn btn-success btn-start" onclick="addClick()">Search</button>    
                                            </div>
                                        </div>
                                     <div class="row mt30" id="resultsdiv" style="display:none">
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

                                                <a href="javascript:void(0)" class="btn btn-success btn-start" style="margin-top:10px;display:none;" id="file">File Your Claim</a>

                                           </div>
                                        </div>

                                        <!-- <div class="row"> 
                                            <div class="col-md-12">
                                               <div class="form-group form-actions mt30 text-center">
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="submitSearch()"><i class="fa fa-angle-right"></i> Search</button>
                                                <button type="reset" class="btn btn-sm btn-info" onclick="resetSearch()"><i class="fa fa-repeat"></i> Reset</button>
                                               </div>
                                            </div>
                                        </div> -->
        </form>
        <div id="dropit" style="display:none">
        <p class="nunito-plain"><span id="faspan" class="fa-stack" style="cursor:pointer;">
            <i class="fa fa-circle fa-stack-2x" style="color: #f9fafc;"></i>
            <i class="fa fa-question fa-stack-1x" style="color:#717171"></i> 
           </span> &nbsp; <b>How to find my VIN</b> </p>
        <form action="fileUpload.php" class="dropzone" id="drop" name="drop" >
        </form><br/>
        <button type="button" class="btn btn-primary pull-right" id="dropSubmit">Submit</button>
        </div>
    </div>
    <div id="fileclaim-modal" class="modal fade mt5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog mt5">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 id="legal-terms-title" class="modal-title display-inline text-primary"><strong>Nice! Looks like you may be eligible.</strong></h2>
            </div>
            <div class="modal-body text-center">
            <div id="termsBody" style="display:none;">
                <img src="../img/FileHappy.png" class="img-responsive center-img" style="max-height:300px">
                <p class="nunito">I'll help you file your claims! Do you already have an account with us?</p>
                <a href="javascript:void(0);" class="btn btn-primary" id="loginButton">Log In</a>
                <a href="javascript:void(0);" class="btn btn-success btn-start" id="signupButton">Sign Up</a>
            </div>    

            <div id="logForm" style="display:none">
            <form id="form-log-in" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="email" id="login-email" name="login-email" class="form-control input-lg" placeholder="Email" value="<?= $email ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group loginUI animation-pullDown">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" id="login-password" name="login-password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-6">
                            <div class="loginUI animation-pullDown">
                                <label class="switch switch-primary">
                                    <input type="checkbox" id="login-remember-me" name="login-remember-me" checked><span></span>
                                </label>
                                <small>Remember me</small>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button id="theButton" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Login</button>
                            <input type="hidden" id="uiFlag" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                       
                    </div>
                </form>
                <div class="text-center">
                    <a href="javascript:void(0)" id="createAccount"><strong>Don't have an account?</strong></a>
                    <a id="reset-pass" href="javascript:void(0)" class="ml50 loginUI"><strong>Forgot password?</strong></a>
                    <a id="login-pass" href="javascript:void(0)" class="ml50 hidden resetUI"><strong>Login</strong></a>
                </div>
            </div>

            <div id="signForm" style="display:none">
                <form id="form-sign-up" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                    <input type="email" id="signup-email" name="signup-email" class="form-control input-lg" placeholder="Email" value="<?= $email ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group loginUI animation-pullDown">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="signup-first-name" name="signup-first-name" class="form-control input-lg" placeholder="First Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group loginUI animation-pullDown">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="signup-last-name" name="signup-last-name" class="form-control input-lg" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-xs-6">
                                
                            </div>
                            <div class="col-xs-6 text-right">
                                <button id="signUpClick" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Sign Up</button>
                                <input type="hidden" id="uiFlag" value="0">
                            </div>
                        </div>
                        <div class="form-group">
    
                        </div>
                        <div class="text-center">
                            <a href="javascript:void(0)" id="haveAccount"><strong>Already have an account?</strong></a>
                        </div>    
                    </form>
                </div>

                <div class="row mt30" id="claimDiv" style="display:none">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">  
                       <div class="table-responsive">
                               <table id="claim-table" class="table table-striped table-vcenter">
                                   <thead>
                                       <tr>
                                           <th class="headFont">Make</th>
                                           <th class="headFont">Model</th>
                                           <th class="headFont">Year</th>
                                           <th class="headFont">VIN</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                   </tbody>
                               </table>
                         </div>
                         <br/>
                         <a href="javascript:void(0)" class="btn btn-success btn-start" style="margin-top:10px;" id="claimSubmit">Submit Claim</a>
                      </div> 
                      <div class="col-md-3">

                      </div>
                   </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-sm btn-primary"><strong>Save</strong></button>
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"><strong>Cancel<strong></button> -->
            </div>
        </div>
    </div>
</div>
<div id="vininfo-modal" class="modal fade mt5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog mt5">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 id="legal-terms-title" class="modal-title display-inline text-primary"><strong>Find your VIN number</strong></h2>
            </div>
            <div class="modal-body text-center">
            <div id="number">
                <img src="../img/VINPIC.png" class="img-responsive center-img" style="max-height:300px">
            </div>   
            <div id="find" style="display:none">
                    <img src="../img/VIN_PIC_002.jpg" class="img-responsive center-img" style="max-height:300px">
                </div>  
            </div>
            <div class=" modal-footer" style="text-align:center">
                    <a href="javascript:void(0);" class="btn btn-primary" id="close">Close</a>
                    &nbsp;<a href="javascript:void(0);" id="options" style="color:#25274d">MORE OPTIONS</a>
                <!-- <button type="button" class="btn btn-sm btn-primary"><strong>Save</strong></button>
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"><strong>Cancel<strong></button> -->
            </div>
        </div>  
    </div>      
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
     let claimVehicles = [];
     let loggedIn; let queryStr = ''; var table; let user_id; let log = false;
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
            if(index == 0)
            {
                options += '<option value= "Value">Choose a Make</option>';    
            }
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
        uniqueModels.sort();
        uniqueYear.sort();
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

Dropzone.options.drop = {
  maxFilesize: 500,
  autoProcessQueue: false,
  init: function() {
                    
    var submitButton = document.querySelector("#dropSubmit")
    myDropzone = this;
    
    submitButton.addEventListener("click", function() {
      
      /* Check if file is selected for upload */
      if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {      
        alert('No file selected for upload');  
        return false;
      }
      else {
        /* Remove event listener and start processing */ 
        // myDropzone.removeEventListeners();
        // myDropzone.processQueue(); 
        let aa = myDropzone.getQueuedFiles()[0];
        console.log(aa[0]);
        var formData = new FormData();
        formData.append('file', aa);
        $.ajax({
        method: 'POST',
        url: 'fileUpload.php',
        data: formData,
        processData: false, // required for FormData with jQuery
        contentType: false, // required for FormData with jQuery
        success: function(response) {
            // do something
            console.log(response);
            let objPass = {user_id:"1234",vinPicURL:"https://docs.classactioninc.com/vinpics/fileName.jpg"};
            App.postData('https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_claims/incoming_webhook/processVINPic?secret=045776bcdf9edcfacc69',JSON.stringify(objSignUp), false, null)
                .then(data => {
                     console.log(data);
                }).catch(data => {

                });

        }
    });
        
      }
    });
    
    
    /* On Success, do whatever you want */
    this.on("success", function(file, responseText) {      
      alert('Success');
    });
  }   
};


function addClick () {
        let make = $('#makeSelect').val();
        let model = $('#model').val();
        let year = $('#year').val();
        let tdStrings = [];
        
        if(model && model.length > 0) {
            model.forEach(element => {
                if(year && year.length > 0) {
                    year.forEach(item => {
                        obj.data.push({"make":make,"model":element,"year":item});
                    });
                } else {
                    obj.data.push({"make":make,"model":element,"year":null});
                }
            });
        } else {
            obj.data.push({"make":make,"model":null,"year":null});
        }

        App.postData('https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_claims/incoming_webhook/checkTakataEligibility?secret=f98c8fc1ec4e87fbcf95',JSON.stringify(obj), false, null)
            .then(data => {
                claimVehicles = [];
                let dataParse = JSON.parse(data);
                console.log(dataParse);
                $("#vehicle-table > tbody").html("");
                if(dataParse.length > 0 || dataParse.length > 0) {
                // $('#resultsdiv').removeClass('hide');
                $('#resultsdiv').show();
                let dataSet  = [];
                dataParse.forEach(element => {
                    if(element.eligible){
                        dataSet.push({make:element.make,model:element.model,year:element.year,eligible:"<span class='text-center label label-primary'>Yes</span>"});
                        document.getElementById('file').style.display = "inline-block";
                        document.getElementById('header-text').innerHTML = "<b>Your Vehicle is Eligible!</b>";
                        claimVehicles.push(element);
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
                        "targets": [0,1,2,3], // your case first column
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

        $('#makeSelect').val('').trigger('chosen:updated');
        $('#model').val('').trigger('chosen:updated');
        $('#year').val('').trigger('chosen:updated');

}

$('#file').on('click', (e) => {
                e.preventDefault();
                loggedIn = "<?php echo $log ?>";
                if(loggedIn || log){
                    let claimSet = [];
                    let i = 0;    
                  claimVehicles.forEach(element => {              
                    claimSet.push({make:element.make,model:element.model,year:element.year,vin:"<input type='text' id='vin-"+i+"'/>"});                                                        
                        i++;
                });
                if ($.fn.DataTable.isDataTable('#claim-table')) {
                    $('#claim-table').DataTable().destroy();
                    $('#claim-table').empty();
                  }
                $('#claim-table').DataTable( {
                    data: claimSet,
                    columns: [
                        { title: "Make", data:"make"},
                        { title: "Model", data:"model" },
                        { title: "Year",data:"year" },
                        { title: "VIN", data:"vin" }
                    ]
                } );
                $('#claimDiv').show();  
                }
                else {
                    console.log("Here");
                    $('#termsBody').show();
                }
                $('#fileclaim-modal').modal();
            });

$('#loginButton').on('click', (e) => {
                e.preventDefault();
                $('#termsBody').hide();
                $('#logForm').show();
                $('#signForm').hide();
            });

$('#signupButton').on('click', (e) => {
                e.preventDefault();
                $('#termsBody').hide();
                $('#logForm').hide();
                $('#signForm').show();
            });   


$('#createAccount').on('click', (e) => {
                e.preventDefault();
                $('#termsBody').hide();
                $('#logForm').hide();
                $('#signForm').show();
            });   

$('#haveAccount').on('click', (e) => {
                e.preventDefault();
                $('#termsBody').hide();
                $('#logForm').show();
                $('#signForm').hide();
            });  

$('#signUpClick').on('click', (e) => {
                e.preventDefault();
                var email = $('#signup-email').val();
                var firstName = $('#signup-first-name').val();
                var lastName = $('#signup-last-name').val();
                var objSignUp = { email:email, fname:firstName, lname:lastName, signup_source:"Takata_Landing" };
                App.postData('https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/addUser?secret=95785b96f6a42f559674',JSON.stringify(objSignUp), false, null)
                .then(data => {
                       let url = "/clarence/";
                       window.location.href = url;
                }).catch(data => {

                });
            });               
            
$('#theButton').on('click', (e) => {
                e.preventDefault();
                App.postData('login.php', JSON.stringify({
                 email: $('#login-email').val(),
                 pass: $('#login-password').val(),
                 cai_uuid: sessionStorage.getItem("uid")
                 }), true, $('#errorDisp')).then(data => {
                  console.log(data);
                  $('#theButton').html('<strong>Logged In</strong>');
                  $('#errorDisp').text('Login successful...').removeClass('alert-danger hidden').addClass('alert-success');
                  $('#termsBody').hide();
                  $('#logForm').hide();
                  $('#claimDiv').show();  
                  user_id = data.user_id;
                  queryStr = 'bptkn=' + data.token;
                  log = true;
                  let claimSet = [];
                    let i = 0;
                  claimVehicles.forEach(element => {              
                        claimSet.push({make:element.make,model:element.model,year:element.year,vin:"<input type='text' id='vin-"+i+"'/>"});                                                        
                        i++;
                });
                if ($.fn.DataTable.isDataTable('#claim-table')) {
                    $('#claim-table').DataTable().destroy();
                    $('#claim-table').empty();
                  }
               table = $('#claim-table').DataTable( {
                    data: claimSet,
                    columnDefs: [{
                    orderable: false,
                    targets: [3]
                    }],
                    columns: [
                        { title: "Make", data:"make"},
                        { title: "Model", data:"model" },
                        { title: "Year",data:"year" },
                        { title: "VIN", data:"vin" }
                    ]
                } );


                }).catch(data => {
                   $('#theButton').attr('disabled', false).html('<i class="fa fa-arrow-right"></i> Login');
                   console.log(data);
                   });        
            });             
            
            
$('#claimSubmit').on('click', (e) => {
                e.preventDefault();
                let vins = [];
               for(var i=0;i<claimVehicles.length; i++){
                let nm = '#vin-'+i;
                let a = $(nm).val();
                vins.push(a);
               }
               console.log(vins);
                vins.forEach(function(item,i){
                    console.log(i);
                    let vinObj = {user_id:user_id,VIN:item};
               App.postData('https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/updateUser?secret=c86b0ca7b5679f291d84',JSON.stringify(vinObj), false, null)
                .then(data => {
                    if(i==vins.length-1)
                    {   
                       console.log("Here It is 1");
                       let url = "/clarence/?" + window.btoa(queryStr);
                       window.location.href = url;
                    }
                }).catch(data => {

                });
                })
            
});     

$('#searchType').on('change', (e) => {
                e.preventDefault();
                console.log(e);
                if(e.target.checked==false){
                    $('#vehicle-form').hide();
                    $('#dropit').show();
                }
                else {
                    $('#vehicle-form').show();
                    $('#dropit').hide();
                }
                
            });  
$('#faspan').on('click', (e) => {
                e.preventDefault();
                console.log("Here?");
                $('#vininfo-modal').modal();
            });
$('#options').on('click', (e) => {
                e.preventDefault();
                $('#number').hide();
                $('#find').show();
            });   
$('#close').on('click', (e) => {
                e.preventDefault();
                $('#vininfo-modal').modal('toggle');
            });                                          
</script>
<?php include '../inc/template_end.php'; ?>