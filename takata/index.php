<?php
require("../inc/config.php");

include '../inc/template_start.php';
include '../inc/page_head.php';
// $json = json_decode(stripslashes(json_decode($userData)));
// var_dump($json);

?>

<section class="site-content site-section" style="height:820px;background:#FFF;">
  <div class="container" style="margin-top:75px;">
    <div class="row mb30">
      <div class="col-lg-5"></div>
      <div class="col-lg-4">  
        <img src="//v.fastcdn.co/t/4b059c2f/c0e5d780/1555940400-34436511-124x124-logo-size-icon-inver.jpg" style="margin-top: 0px;" alt="">
      </div>
      <div class="col-lg-4"></div>
    </div>
    <div class="row mb30">
        <div class="col-lg-3"></div>  
        <div class="col-lg-7">
            <h2> &nbsp;Affected vehicles: Takata settlement</h2>
        </div>    
        <div class="col-md-2"></div>
    </div>
    <div class="row mt30">
        <div class="col-lg-5"></div>  
        <div class="col-lg-3">
        <a href="/clarence/?" class="btn btn-lg btn-success btn-alt">File Your Claim</a>
        </div>    
        <div class="col-md-4"></div>
    </div>
    <div class="row mt30">
        <form action="#" method="post" class="form-horizontal form-bordered" id="vehicle-form" onsubmit="return false;">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="example-typeahead">Make</label>
                                            <div class="col-md-6">
                                            <select id="makeSelect" name="make" class="select-chosen" data-placeholder="Choose a Make.." style="width: 250px;" onchange="changeMake(this)">
                                                        <option value="Value"></option>
                                            </select>            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="example-typeahead">Model</label>
                                            <div class="col-md-6">
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

                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="example-typeahead">Year</label>
                                            <div class="col-md-6">
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
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-sm btn-danger" onclick="addClick()">Add</button>    
                                            </div>
                                        </div>
                                     <div class="row">
                                         <div class="col-md-4"></div>
                                         <div class="col-md-4">  
                                            <div class="table-responsive">
                                                    <table id="vehicle-table" class="table table-striped table-vcenter">
                                                        <thead>
                                                            <tr>
                                                                <th class="headFont">Make</th>
                                                                <th class="headFont">Model</th>
                                                                <th class="headFont">Year</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                              </div>
                                           </div> 
                                           <div class="col-md-4"></div>
                                        </div>
                                        
                                        <div class="form-group form-actions">
                                            <div class="col-md-7 col-md-offset-5">
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="submitSearch()"><i class="fa fa-angle-right"></i> Search</button>
                                                <button type="reset" class="btn btn-sm btn-warning" onclick="resetSearch()"><i class="fa fa-repeat"></i> Reset</button>
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
//   const claimData = JSON.parse();
//   console.log(claimData);

//   App.datatables();
//   let data = Array();

//   $.each(claimData.claimData, function(idx, item) {
//     let sett = claimData.settsData.find(x => x.settlement_id == item.settlement_id);
//     let edate = sett.settlement_timeline.find(x => x.dateName == 'Estimated Distribution Date');
//     console.log(edate);
//     if(edate==undefined)
//     { edate = 'TBD'; } 
//     console.log(edate.dateValue);
//     let dateValue = edate.dateValue;
//     const estPerItem = sett.CAA_calculations.est_amt_per_item;
//     const darFlag = sett.CAA_calculations.use_claimData_for_DAR;
//     let estValue = '$0.00';

//     if(darFlag) {
//       estValue = Object.keys(item.clientClaims.claimData).map(x => {
//         return (parseFloat(item.clientClaims.claimData[x]) * estPerItem);
//       }).reduce((partial_sum, a) => partial_sum + a).toFixed(2);
//     } else {
//       estValue = '$' + estPerItem.toLocaleString('en');
//     }
//     console.log(idx);
//     let link="";
//     display = "";
//     if(sett.hasOwnProperty('settlement_doc_href')){
//       link = sett.settlement_doc_href;
//     }
//     else {
//       display = 'none';
//     }
    
//     data.push({
//       Settlement_Name: sett.settlement_client_name+' <a href="'+link+'" target="_blank" style="display:'+display+'"><i class="fa fa-info-circle"></i></a>',
//       Filed_On: formatStrToDteTimeStr(item.clientClaims.createTS),
//       // Status: 'Filing Preparation',
//       //final_approval_hearing: formatStrToDteTimeStr(sett.settlement_timeline.dateValue, true),
//       Estimated_Distribution_Date: formatStrToDteTimeStr(dateValue),
//       Estimated_Value: '$' + estValue.toLocaleString('en')
//     })
    
//   });

//   $('#claims-listing').DataTable({
//     data: data,
//     columnDefs: [
//         { sClass: "text-center text-wrap", targets: [3] },
//         { targets: '_all', orderable: true, createdCell: function (td, cellData, rowData, row, col) {
//                 $(td).css('padding', '2px 10px')
//                 if(col==2) {
//                   $(td).css('text-align', 'center')
//                 }
//             }
//         }
//     ],
//     columns: Object.keys(data[0]).map(x => {
//         if (x === 'Estimated_Distribution_Date')
//         {
//           return {data:x, title: '<div class="text-center">Estimated <br/> Distribution Date</div>'};  
//         }
//         else {
//           return {data:x, title: x.replace(/_/g," ")};
//         }
        
//     })
//   });

//   function formatStrToDteTimeStr(strInput, bJustDate = false) {
//     if(strInput == null) { return ''; }

//     let temp = moment(strInput);

//     if(bJustDate) {
//       // return temp.format("MMM DD YYYY");
//       return temp.format("MM/DD/YY");
//     } else {
//       // return temp.format("MMM DD YYYY hh:mm:ss a");
//       return temp.format("MM/DD/YY");
//     }
//   }

//   function capitalizeFirstLetter(string) {
//     return string.charAt(0).toUpperCase() + string.slice(1);
//   }
</script>
<?php include '../inc/template_end.php'; ?>