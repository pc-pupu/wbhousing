<?php

global $base_root, $base_path, $user_role;
$isVal = $output[0];
//echo "<pre>";print_r($page_status);die;
if($isVal){
	$application_arr = $output[2];
	$entityList = $application_arr[0];

	$fields = $entityList['fields'];
	$expressions = $entityList['expressions'];
	
	
	$entityType = $entityList['type'];
	$application_data = $application_arr[1]; 
	$common_data = $output[1];
	$applicant_data = $output[3];

  // echo '<pre>';
	// print_r($common_data); die('ok');

  if(isset($output[4]))
  $status_description=$output[4];	
	
	#krumo($applicant_data);
	/*if($common_data->status == 'applied'){
 		$options['attributes']['class'] = array('button','link-button','round','child-tab','child-color-sea');
 		$options['attributes']['style'] = 'float:right;';
		echo l('Reject' ,  'update_status/'.encrypt_url($common_data->online_application_id).'/'.encrypt_url('reject'),							$options).l('Verify' , 'update_status/'.encrypt_url($common_data->online_application_id).'/'.encrypt_url('verified'),							$options);
	}*/
	//echo $common_data->online_application_id;
  //echo "<pre>";print_r($output);die;
?>


	<?php
		$filename = str_replace( ' ', '', $entityType );
		$custom_filename = $common_data->application_no;
		$download_path = "sites/default/files/";
	?>
    <div class="table-bottom">
      <table class="table table-list"><!--sd 21-06-2024--->
		  <tr>
     <?php
  		if($common_data->uri_app_form != '') {
  			$path = substr($common_data->uri_app_form, 9);
  			$custom_file_name = $custom_filename.'_Signed_Form';
	   ?>
				<td colspan="2">
        <?php					
    		/*echo l('<img height="18" width="18" src="../'.drupal_get_path('module', 'view_application_list').'/images/pdf_icon.png" title="Download Application" alt="PDF Icon">Download Application', 'application_detail_pdf/'.encrypt_url($common_data->online_application_id).'/App_Details_'.$common_data->application_no, array('html'=>TRUE, 'attributes' => array('target' => '_blank', 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));*/
    		
    			/*echo l('<img height="30" width="30" src="'.$base_path.drupal_get_path('module', 'view_application_list').'/images/download.png" title="Download Signed 
    			Application Form" alt="Download Icon">Download Signed Application Form', $download_path.$path, array('html'=>TRUE, 
    			'attributes' => array('download' => $custom_file_name, 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));*///turned off sd 21-06-2024

          echo l('Download Signed Application Form',$download_path.$path,array('html'=>TRUE,'attributes' => array('download' => $custom_file_name, 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder ')));//sd 21-06-2024
    	   ?>
        </td>
      <?php
  		}
  	 ?>
    	</tr>
      <tr>
    <?php
////////// code off by debaleena/////


		/* if(trim($entityType) == 'New Allotment') {
			if($common_data->uri_doc != '') {
				$path = substr($common_data->uri_doc, 9);
				$custom_file_name = $custom_filename.'_Payslip';
	?>
    		
    <td>
    <?php					
		// echo l('<img height="30" width="30" src="'.$base_path.drupal_get_path('module', 'view_application_list').'/images/download_icon.png" title="Download Payslip" alt="PDF Icon">Download Payslip', $download_path.$path, array('html'=>TRUE, 'attributes' => array('download' => $custom_file_name, 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));//sd turned off 21-06-2024
     
     echo l('Download Payslip',$download_path.$path,array('html'=>TRUE,'attributes' => array('download' => $custom_file_name, 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder ')));//sd 21-06-2024

	?>
    </td>
    <?php
			}
			if($common_data->uri_extra_doc != '') {
				$path = substr($common_data->uri_extra_doc, 9);
				$custom_file_name = $custom_filename.'_Category_Supporting_Doc';
	?>
    <td> 
    <?php					
		echo l('<img height="30" width="30" src="../'.drupal_get_path('module', 'view_application_list').'/images/download_icon.png" title="Download Allotment Reason Supporting Document" alt="PDF Icon">Download Allotment Reason Supporting Document', $download_path.$path, array('html'=>TRUE, 'attributes' => array('download' => $custom_file_name, 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));
	?>
                </td>
    <?php		
			}
    } */
    if($common_data->status == 'applicant_acceptance' || $common_data->status == 'ddo_verified_2' || $common_data->status == 'housing_sup_approved_2' || $common_data->status == 'applicant_acceptance' || $common_data->status == 'applicant_reject' || $common_data->status == 'ddo_reject_2' || $common_data->status == 'housing_sup_reject_2'){ ?>
      <tr><td>

        <?php 
            // echo l('<img height="30" width="30" src="'.$base_path.drupal_get_path('module', 'application_of_registration_list').'/images/download_icon.png " title="Download Offer Letter" alt="PDF Icon">Uploaded Current Pay Slip',$output['doc']['current_pay_slip_url'],array('html' => true , 'attributes'=> array('download' => $output['doc']['license_application_signed_form_fname'], 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px'))); //turned odd sd 21-06-2024

          echo l('Uploaded Current Pay Slip',$output['doc']['current_pay_slip_url'],array('html'=>TRUE,'attributes' => array('download' => $output['doc']['license_application_signed_form_fname'], 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder')));//sd 21-06-2024
        ?>
        
          
      </td></tr>

      <tr><td>
        <?php 
        // echo l('<img height="30" width="30" src="'.$base_path.drupal_get_path('module', 'application_of_registration_list').'/images/download_icon.png " title="Declaration Form" alt="PDF Icon">Uploaded Declaration Signed Form',$output['doc']['declaration_signed_form_url'],array('html'=>true,'attributes'=>array('download' => $output['doc']['declaration_signed_form_fname'], 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px'))); // turned off sd 21-06-2024

        echo l('Uploaded Declaration Signed Form',$output['doc']['declaration_signed_form_url'],array('html'=>TRUE,'attributes' => array('download' => $output['doc']['declaration_signed_form_fname'], 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder')));//sd 21-06-2024
      ?></td></tr>

      <tr><td>
        <?php 
        // echo l('<img height="30" width="30" src="'.$base_path.drupal_get_path('module', 'application_of_registration_list').'/images/download_icon.png " title="Licence Form" alt="PDF Icon">Uploaded Licence Application Signed Form',$output['doc']['license_application_signed_form_url'],array('html'=>true,'attributes'=>array('download' => $output['doc']['current_pay_slip_fname'], 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));  turned off sd 21-06-2024

        echo l('Uploaded Declaration Signed Form',$output['doc']['license_application_signed_form_url'],array('html'=>TRUE,'attributes' => array('download' => $output['doc']['current_pay_slip_fname'], 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder')));//sd 21-06-2024

      ?></td></tr>

      <?php
      
		}
		if(trim($entityType) == 'Vertical Shifting') {
			if($common_data->uri_vs != '') {
				$path = substr($common_data->uri_vs, 9);
				$custom_file_name = $custom_filename.'_Current_Licence';
	?>
    			<td>
    <?php					
		// echo l('<img height="30" width="30" src="../'.drupal_get_path('module', 'view_application_list').'/images/download_icon.png" title="Download Current Licence" alt="PDF Icon">Download Current Licence', $download_path.$path, array('html'=>TRUE, 'attributes' => array('download' => $custom_file_name, 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));//turned off sd 21-06-2024

    echo l('Download Current Licence',$download_path.$path,array('html'=>TRUE,'attributes' => array('download' => $custom_file_name, 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder')));//sd 21-06-2024
	?>
                </td>
    <?php
			}			
		}
		else if(trim($entityType) == 'Category Shifting') {
			if($common_data->uri_cs != '') {
				$path = substr($common_data->uri_cs, 9);
				$custom_file_name = $custom_filename.'_Current_Licence';
	?>
    			<td>
    <?php					
		    //echo l('<img height="30" width="30" src="../'.drupal_get_path('module', 'view_application_list').'/images/download_icon.png" title="Download Current Licence" alt="PDF Icon">Download Current Licence', $download_path.$path, array('html'=>TRUE, 'attributes' => array('download' => $custom_file_name, 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));//turned off sd 21-06-2024

      echo l('Download Current Licence',$download_path.$path,array('html'=>TRUE,'attributes' => array('download' => $custom_file_name, 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder')));//sd 21-06-2024
	?>
                </td>
    <?php
			}			
		}
		else if(trim($entityType) == 'New Licence' || trim($entityType) == 'VS Licence' || trim($entityType) == 'CS Licence' || trim($entityType) == 'Renew Licence') {
			if($common_data->uri_licence != '') {
				$path = substr($common_data->uri_licence, 9);
				$custom_file_name = $custom_filename.'_Necessary_Doc_Payslip';
	?>
    			<td>
    <?php					
		//echo l('<img height="30" width="30" src="../'.drupal_get_path('module', 'view_application_list').'/images/download_icon.png" title="Download Necessary Document" alt="PDF Icon">Download Necessary Document', $download_path.$path, array('html'=>TRUE, 'attributes' => array('download' => $custom_file_name, 'style' => 'color: #0090C7;font-weight: 400;text-decoration: none; font-size:14px')));//turned off sd 21-06-2024

    echo l('Download Necessary Document',$download_path.$path,array('html'=>TRUE,'attributes' => array('download' => $custom_file_name, 'class' => 'btn bg-dark  px-5 rounded-pill text-white fw-bolder')));//sd 21-06-2024


	?>
                </td>
    <?php
			}			
		}
	?>
    		</tr>
        </table>
    </div>

<div class="table-bottom">
  <table class="table table-list"><!-- sd 21-06-2024-->
  <tr>
  <th colspan="2" style="background: none repeat scroll 0 0 #473a39;color:white;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Application Status</th>
  </tr>
    <tr>
      <th style="background-color:#00000000" width="50%">Application Type</th>
      <td width="50%"><?php echo 'Application for '.$entityType;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000" width="50%">Application No.</th>
      <td width="50%"><?php echo $common_data->application_no;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Date of Application</th>
      <td><?php echo implode('/', array_reverse(explode('-', $common_data->date_of_application)));?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Application Status</th>
      <!--debolina start-->
     <!--  <td><?php //echo ($common_data->status == 'allotted') ? 'Allotted Offer' : $common_data->status;?></td> -->
     <td><?php if($page_status=='verified-list'){
      echo $common_data->status_description;
      }else if ($page_status=='action-list'){
      echo $status_description;  
      }
      ?> 
     </td>
     <!--debolina end-->
  </td>
      
    </tr>
    <tr>
      <th style="background-color:#00000000">Date of Action</th>
      <td><?php 
              if(isset($common_data->date_of_verified))
                echo implode('/', array_reverse(explode('-', $common_data->date_of_verified)));
              else
                echo 'Not Verified';


          ?></td>
    </tr>

<?php
	 $headArr = array();
	 $valArr = array();
	 $l = 0;
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
  <th colspan="2" style="background: none repeat scroll 0 0 #473a39;color:white;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant Personal Information(According to Service Book)</th>
  </tr>
    <tr>
      <th style="background-color:#00000000">Applicant's Name</th>
      <td ><?php echo $applicant_data->applicant_name;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Father's / Husband's Name</th>
      <td><?php echo $applicant_data->guardian_name;?></td>
    </tr>
    
    <?php
		$result_permanent = particular_district_list($applicant_data->permanent_district);
		$data_permanent = $result_permanent->fetchObject();
    //echo "<pre>";print_r($applicant_data);die;
		
		$permanent_address = $applicant_data->permanent_street.', P.O - '.$applicant_data->permanent_post_office.', '.$applicant_data->permanent_city_town_village.', '.$applicant_data->permanent_district.' - '.$applicant_data->permanent_pincode;
		
		if($applicant_data->permanent_present_same == 1) {
			$present_address = $permanent_address;
		} else {
			$result_present = particular_district_list($applicant_data->present_district);
			$data_present = $result_present->fetchObject();
			
			$present_address = $applicant_data->present_street.', P.O - '.$applicant_data->present_post_office.', '.$applicant_data->present_city_town_village.', '.$applicant_data->permanent_district.' - '.$applicant_data->present_pincode;	
		}
	?>
    
    <tr>
      <th style="background-color:#00000000">Permanent Address</th>
      <td><?php echo $permanent_address;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Present Address</th>
      <td><?php echo $present_address;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Gender</th>
      <td><?php echo $applicant_data->gender == 'M'?'Male':'Female';?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Date of Birth(According to Service Book)</th>
      <td><?php echo implode('/', array_reverse(explode('-', $applicant_data->date_of_birth)));?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Mobile No</th>
      <td><?php echo $applicant_data->mobile_no;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Email ID</th>
      <td><?php echo $applicant_data->mail ;?></td>
    </tr>
<tr>
  <th colspan="2" style="background: none repeat scroll 0 0 #473a39;color:white;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant Official Information</th>
  </tr>
  	<tr>
      <th style="background-color:#00000000">Employee HRMS ID</th>
      <td ><?php echo $common_data->hrms_id;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Designation</th>
      <td ><?php echo $common_data->applicant_designation;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Office Headquarter</th>
      <td><?php echo $common_data->applicant_headquarter;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Place of Posting</th>
      <td><?php echo $common_data->applicant_posting_place;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Pay Band</th>
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
    <tr>
      <th style="background-color:#00000000">Basic Pay</th>
      <td><?php echo $common_data->pay_in_the_pay_band;?></td>
    </tr>
    <!-- <tr>
      <th style="background-color:#00000000">Grade Pay</th>
      <td><?php //echo $common_data->grade_pay;?></td>
    </tr> -->
    
   <?php /*?> <tr>
      <th style="background-color:#00000000">GPF No.</th>
      <td><?php echo $common_data->gpf_no;?></td>
    </tr><?php */?>
    
    <tr>
      <th style="background-color:#00000000">Date of Joining</th>
      <td><?php echo implode('/', array_reverse(explode('-', $common_data->date_of_joining)));?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Date of Retirement(According to Service Book)</th>
      <td><?php echo implode('/', array_reverse(explode('-', $common_data->date_of_retirement)));?></td>
    </tr>
  <tr>
  <th colspan="2" style="background: none repeat scroll 0 0 #473a39;color:white;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant Office Name and Address</th>
  </tr>
    <tr>
      <th style="background-color:#00000000">Name of the Office</th>
      <td><?php echo $common_data->office_name;?></td>
    </tr>
    
    <?php
		$result_office = particular_district_list($common_data->office_district);
		$data_office = $result_office->fetchObject();
		//echo "<pre>";print_r($common_data);die;
		$office_address = $common_data->office_street.', P.O - '.$common_data->office_post_office.', '.$common_data->office_city_town_village.', '.$common_data->office_district.' - '.$common_data->office_pin_code;
	?>
    
    <tr>
      <th style="background-color:#00000000">Office Address</th>
      <td><?php echo $office_address;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">Office Phone No.</th>
      <td><?php echo $common_data->office_phone_no;?></td>
    </tr>
    <tr>
  		<th colspan="2" style="background: none repeat scroll 0 0 #473a39;color:white;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first">Applicant DDO Information</th>
  	</tr>
    <tr>
      <th style="background-color:#00000000">DDO District</th>
      <td><?php echo $common_data->district_name;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">DDO Designation</th>
      <td><?php echo $common_data->ddo_designation;?></td>
    </tr>
    <tr>
      <th style="background-color:#00000000">DDO Address</th>
      <td><?php echo $common_data->ddo_address;?></td>
    </tr>
    
    <tr>
  		<th colspan="2" style="background: none repeat scroll 0 0 #473a39;color:white;text-align: center;font-size: 18px;line-height: 24px;font-weight: normal;font-family: 'Dosis',Arial,Verdana,serif;" class="first"><?php echo $heading;?></th>
</tr>

     <?php 
//echo "<pre>";print_r($headArr);
    if(trim($entityType) == 'New Allotment') 
      {
      ?>
        <tr>
          <th style="background-color:#00000000"><?php echo $headArr[0];?></th>
          <td ><?php 
              echo $application_data->allotment_category;
        ?></td>
      </tr>
      <tr>
        <th style="background-color:#00000000"><?php echo $headArr[1];?></th>
          <td ><?php 
              echo $application_data->flat_type;
        ?></td>
      </tr>

        <?php 
      }else if(trim($entityType) == 'Vertical Shifting' || trim($entityType) == 'Category Shifting')
      {
        ?>
        <tr>
          <th style="background-color:#00000000"><?php echo $headArr[0];?></th>
          <td ><?php 
              echo $application_data->possession_date;
        ?></td>
      </tr>
      <tr>
        <th style="background-color:#00000000"><?php echo $headArr[1];?></th>
          <td ><?php 
              echo $application_data->estate_name;
        ?></td>
      </tr>
      <tr>
        <th style="background-color:#00000000"><?php echo $headArr[2];?></th>
          <td ><?php 
              echo $application_data->block_name;
        ?></td>
      </tr>
      <tr>
        <th style="background-color:#00000000"><?php echo $headArr[3];?></th>
          <td ><?php 
              echo $application_data->flat_no;
        ?></td>
      </tr>

        <?php 

      }else{

        while($l < count($headArr)){?>
        <tr>
          <th style="background-color:#00000000"><?php echo $headArr[$l];?></th>
          <td ><?php echo $valArr[$l];?></td>
        </tr>

        <?php $l++; }$l = 0;

      } ?>
  </table>
</div>

<?php
}else { ?>
Invalid Access
<?php } ?>
