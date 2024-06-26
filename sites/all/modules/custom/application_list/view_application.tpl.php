
<?php

$isVal = $output[0];
if($isVal){
	$application_arr = $output[2];
	$entityList = $application_arr[0];
	$fields = $entityList['fields'];
	$expressions = $entityList['expressions'];
	$entityType = $entityList['type'];
	$application_data = $application_arr[1];
	$common_data = $output[1];
	$applicant_data = $output[3];
   //echo "<pre>";print_r($output);exit;

  //debolina start
  $status_description=$output[4]; 
  //debolina end
?>
<div class="table-bottom">
	
	<?php
	$filename = str_replace( ' ', '', $entityType );
	
    echo l('<img height="18" width="18" src="../'.drupal_get_path('module', 'application_list').'/images/pdf_icon.png" title="Download Application" alt="PDF Icon">Download Application', 'application-pdf-gen/'.encrypt_url($common_data->online_application_id).'/App_Details_'.$common_data->application_no, array('html'=>TRUE, 'attributes' => array('target' => '_blank', 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));
    ?>
           
</div>

<!--Appication display theme new copy-->
<div class="table-bottom">
  <table >
  <tr>
  <th colspan="2" style="background: none repeat scroll 0 0 #5996d9;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Application Status</th>
  </tr>
    <tr>
      <th style="background-color:#a1baef" width="50%">Application Type</th>
      <td width="50%"><?php echo 'Application for '.$entityType;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef" width="50%">Application No.</th>
      <td width="50%"><?php echo $common_data->application_no;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Date of Application</th>
      <td><?php echo implode('/', array_reverse(explode('-', $common_data->date_of_application)));?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Application Status</th>
      <!-- <td><?php //echo ($common_data->status == 'allotted') ? 'Allotted Offer' : $common_data->status;?></td> -->
      <!-- debolina start-->
      <td>
        <?php if(isset($status_description)){
        echo $status_description;
        }
        else{
          echo 'NA'; 
        }?>
      </td>
      <!-- debolina end-->
    </tr>
    <!-- <tr>
      <th style="background-color:#a1baef">Date of Action</th>
      <td><?php //echo implode('/', array_reverse(explode('-', $common_data->date_of_verified)));?></td>
    </tr> -->

<?php
	 $headArr = array();
	 $valArr = array();
   $l = 0;
   //echo "<pre>";print_r($application_data);exit;
  // print_r($fields);
	  if(count($expressions) != 0){
	  foreach($expressions as $entityAlias => $columnHeadFieldSet ){
			foreach($columnHeadFieldSet as $columnHead => $expression){
				$headArr[$l] = $columnHead;
				//$valArr[$l] = $application_data->$expression[1];
        $valArr[$l] = $application_data;
				$l++;
	   }}} 
	    if(count($fields) != 0){
	  foreach($fields as $entityAlias => $columnHeadFieldSet ){
			foreach($columnHeadFieldSet as $columnHead => $field){

				$headArr[$l] = $columnHead;
				//$valArr[$l] = $application_data->$field[1];
        $valArr[$l] = $application_data;
				$l++;
	 }}} 
	 $l = 0;
	// echo "<pre>";print_r($field);die;
	if(trim($entityType) == 'New Allotment') {
		$heading = 'Information for Allotment';
	}
	else if(trim($entityType) == 'Vertical Shifting' || trim($entityType) == 'Category Shifting') {	
		$heading = 'Possession Details';
	}
	else if(trim($entityType) == 'New Licence' || trim($entityType) == 'VS Licence' || trim($entityType) == 'CS Licence' || trim($entityType) == 'Renew Licence') {
		$heading = 'Allotment Details';	
	}
		
?>

<tr>
  <th colspan="2" style="background: none repeat scroll 0 0 #5996d9;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant Personal Information(According to Service Book)</th>
  </tr>
    <tr>
      <th style="background-color:#a1baef">Applicant's Name</th>
      <td ><?php echo $applicant_data->applicant_name;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Father's / Husband's Name</th>
      <td><?php echo $applicant_data->guardian_name;?></td>
    </tr>
    
    <?php
		$result_permanent = particular_district_list($applicant_data->permanent_district);
		$data_permanent = $result_permanent->fetchObject();
		
		$permanent_address = $applicant_data->permanent_street.', P.O - '.$applicant_data->permanent_post_office.', '.$applicant_data->permanent_city_town_village.', '.$data_permanent->district_name.' - '.$applicant_data->permanent_pincode;
		
		if($applicant_data->permanent_present_same == 1) {
			$present_address = $permanent_address;
		} else {
			$result_present = particular_district_list($applicant_data->present_district);
			$data_present = $result_present->fetchObject();
			
			$present_address = $applicant_data->present_street.', P.O - '.$applicant_data->present_post_office.', '.$applicant_data->present_city_town_village.', '.$data_present->district_name.' - '.$applicant_data->present_pincode;	
		}
	?>
    
    <tr>
      <th style="background-color:#a1baef">Permanent Address</th>
      <td><?php echo $permanent_address;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Present Address</th>
      <td><?php echo $present_address;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Gender</th>
      <td><?php echo $applicant_data->gender == 'M'?'Male':'Female';?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Date of Birth(According to Service Book)</th>
      <td><?php echo implode('/', array_reverse(explode('-', $applicant_data->date_of_birth)));?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Mobile No</th>
      <td><?php echo $applicant_data->mobile_no;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Email ID</th>
      <td><?php echo $applicant_data->mail ;?></td>
    </tr>
<tr>
  <th colspan="2" style="background: none repeat scroll 0 0 #5996d9;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant Official Information</th>
  </tr>
  	<tr>
      <th style="background-color:#a1baef">Employee HRMS ID</th>
      <td ><?php echo $common_data->hrms_id;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Designation</th>
      <td ><?php echo $common_data->applicant_designation;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Office Headquarter</th>
      <td><?php echo $common_data->applicant_headquarter;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Place of Posting</th>
      <td><?php echo $common_data->applicant_posting_place;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Pay Band</th>
      <?php
             if($common_data->scale_from == 0 && $common_data->scale_to != 0){
                //$str =  $common_data->payband.' (Below Rs '.$common_data->scale_to.'/-)';
                $str =  $common_data->flat_type.' (Below Rs '.$common_data->scale_to.'/-)';
            }else if($common_data->scale_from != 0 && $common_data->scale_to == 0){
                //$str =  $common_data->payband.' (Rs '.$common_data->scale_from.'/- and above)';
                $str =  $common_data->flat_type.' (Rs '.$common_data->scale_from.'/- and above)';
            }else{
              //$str = $common_data->payband.' (Rs '.$common_data->scale_from.'/- to Rs '.$common_data->scale_to.'/-)';
              $str = $common_data->flat_type.' (Rs '.$common_data->scale_from.'/- to Rs '.$common_data->scale_to.'/-)';
            }?>
      <td><?php echo $str;?></td>
    </tr>
    <!-- <tr>
      <th style="background-color:#a1baef">Pay in Pay Band</th>
      <td><?php //echo $common_data->pay_in_the_pay_band;?></td>
    </tr> -->
    <!-- <tr>
      <th style="background-color:#a1baef">Grade Pay</th>
      <td><?php //echo $common_data->grade_pay;?></td>
    </tr> -->
    <tr>
      <th style="background-color:#a1baef">Basic Pay</th>
      <td><?php echo $common_data->pay_in_the_pay_band;?></td>
    </tr>
    
   <?php /*?> <tr>
      <th style="background-color:#a1baef">GPF No.</th>
      <td><?php echo $common_data->gpf_no;?></td>
    </tr><?php */?>
    
    <tr>
      <th style="background-color:#a1baef">Date of Joining</th>
      <td><?php echo implode('/', array_reverse(explode('-', $common_data->date_of_joining)));?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Date of Retirement(According to Service Book)</th>
      <td><?php echo implode('/', array_reverse(explode('-', $common_data->date_of_retirement)));?></td>
    </tr>
  <tr>
  <th colspan="2" style="background: none repeat scroll 0 0 #5996d9;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant Office Name and Address</th>
  </tr>
    <tr>
      <th style="background-color:#a1baef">Name of the Office</th>
      <td><?php echo $common_data->office_name;?></td>
    </tr>
    
    <?php
		$result_office = particular_district_list($common_data->office_district);
		$data_office = $result_office->fetchObject();
		
		$office_address = $common_data->office_street.', P.O - '.$common_data->office_post_office.', '.$common_data->office_city_town_village.', '.$data_office->district_name.' - '.$common_data->office_pin_code;
	?>
    
    <tr>
      <th style="background-color:#a1baef">Office Address</th>
      <td><?php echo $office_address;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">Office Phone No.</th>
      <td><?php echo $common_data->office_phone_no;?></td>
    </tr>
    <tr>
  		<th colspan="2" style="background: none repeat scroll 0 0 #5996d9;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant DDO Information</th>
  	</tr>
    <tr>
      <th style="background-color:#a1baef">DDO District</th>
      <td><?php echo $common_data->district_name;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">DDO Designation</th>
      <td><?php echo $common_data->ddo_designation;?></td>
    </tr>
    <tr>
      <th style="background-color:#a1baef">DDO Address</th>
      <td><?php echo $common_data->ddo_address;?></td>
    </tr>
    
    <tr>
 		<th colspan="2" style="background: none repeat scroll 0 0 #5996d9;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first"><?php echo $heading;?></th>
</tr>


    <?php 
//echo "<pre>";print_r($application_data);
    if(trim($entityType) == 'New Allotment') 
      {
      ?>
        <tr>
          <th style="background-color:#a1baef"><?php echo $headArr[0];?></th>
          <td ><?php 
              echo $application_data->allotment_category;
        ?></td>
      </tr>
      <tr>
        <th style="background-color:#a1baef"><?php echo $headArr[1];?></th>
          <td ><?php 
              echo $application_data->flat_type;
        ?></td>
      </tr>

        <?php 
      }else if(trim($entityType) == 'Vertical Shifting')
      {
         ?>
      <tr>
          <th style="background-color:#a1baef"><?php echo $headArr[0];?></th>
          <td ><?php 
              echo $application_data->possession_date;
        ?></td>
      </tr>
      <tr>
        <th style="background-color:#a1baef"><?php echo $headArr[1];?></th>
          <td ><?php 
              echo $application_data->estate_name;
        ?></td>
      </tr>

      <tr>
        <th style="background-color:#a1baef"><?php echo $headArr[2];?></th>
          <td ><?php 
              echo $application_data->block_name;
        ?></td>
      </tr>
      <tr>
        <th style="background-color:#a1baef"><?php echo $headArr[3];?></th>
          <td ><?php 
              echo $application_data->flat_no;
        ?></td>
      </tr>

      <?php 

      }else{

        while($l < count($headArr)){?>
        <tr>
          <th style="background-color:#a1baef"><?php echo $headArr[$l];?></th>
          <td ><?php echo $valArr[$l];?></td>
        </tr>

        <?php $l++; }$l = 0;

      } ?>

  </table>
</div>
<!--End-->

<?php }else { ?>

	Invalid Access

<?php } ?>