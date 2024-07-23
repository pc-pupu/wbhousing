<?php

function view_app_page($status ='', $entity = '',$page_status ='') {
	//echo $status;die;
	global $user_role;
	$status = decrypt_url($status);
	$entity = decrypt_url($entity);
	//echo $status;echo $entity;echo $page_status; die();
	$output = '';
	$rows =array(); //sd turned off 21-06-2024 //debaleena turned on 09-07-2024
	//$header = array(); //sd turned off 21-06-2024
	$statusMsg ='';
	
	if($status !== '' && $entity !== '' && preg_match("/^[a-zA-Z0-9\-\_]*$/",$status) && preg_match("/^[a-zA-Z0-9\-\_]*$/",$entity)){
		if($status == 'applied'){
			$statusMsg = 'Submitted ';
		}else if($status == 'ddo_verified_1'){
			$statusMsg = 'DDO (Level-1) Verified ';
		}else if($status == 'ddo_rejected_1'){
			$statusMsg = 'DDO (Level-1) Rejected ';
		}else if($status == 'housing_sup_approved_1'){
			$statusMsg = 'Housing Supervisor(Level-1) Verified ';
		}else if($status == 'housing_sup_reject_1'){
			$statusMsg = 'Housing Supervisor(Level-1) Rejected ';
		}else if($status == 'housing_official_approved'){
			$statusMsg = 'Housing Official Verified ';
		}else if($status == 'housing_official_rejected'){
			$statusMsg = 'Housing Official Rejected ';
		}else if($status == 'ddo_verified_2'){
			$statusMsg = 'DDO (Level-2) Verified ';
		}else if($status == 'ddo_rejected_2'){
			$statusMsg = 'DDO (Level-2) Rejected ';
		}else if($status == 'housing_sup_approved_2'){
			$statusMsg = 'Housing Supervisor(Level-2) Verified ';
		}else if($status == 'housing_sup_reject_2'){
			$statusMsg = 'Housing Supervisor(Level-2) Rejected ';
		}else if($status == 'applicant_acceptance'){
			$statusMsg = 'Allotted ';
		}


		/*else if($status == 'verified'){
			$statusMsg = 'Verified ';
		}
		else if($status == 'reject'){
			$statusMsg = 'Rejected ';
		}*/
		
		if($entity == 'new-apply'){
			$entityMsg = 'New Allotment ';
		}
		else if($entity == 'vs'){
			$entityMsg = 'Vertical Shifting ';
		}
		else if($entity == 'cs'){
			$entityMsg = 'Category Shifting ';
		}
		else if($entity == 'new_license'){
			$entityMsg = 'New Licence ';
		}
		
		//new code
		else if($entity == 'vs_licence'){
			$entityMsg = 'VS Licence ';
		}
		else if($entity == 'cs_licence'){
			$entityMsg = 'CS Licence ';
		}
		//
		
		else if($entity == 'renew_license'){
			$entityMsg = 'Renew Licence ';
		}
			
		drupal_set_title($statusMsg.'Application List for '.$entityMsg);
			
		
		// $result = fetch_all_application_detail1($entity,$status);
		if($page_status=='action-list'){
			$result = application_list_fetch($entity,$status);//sd
		}else if($page_status=='verified-list'|| $page_status=='reject-list'){
			$result = application_list_fetch_for_verified_reject($entity,$status);
		}
		

		// echo "<pre>";print_r($result);die;


		$header = array(
			'applicant_name' => array(
				'data' => 'Name'
			) ,
			'application_no' => array(
				'data' => 'Application No.',
				'width'=>'20%'
			) 
		);
		
		
		// if($status == 'applied' || $status == 'ddo_verified_1' || $status == 'housing_sup_approved_1' || $status == 'housing_official_approved'){
		// 	$header['date_of_application'] = array('data' => 'Date of Application');
		// }
		//$header[] = array('data' => 'Time of Application');
		
		if($entity == 'new-apply'||$entity == 'vs'||$entity == 'cs'){//echo $status;
			if($page_status == 'verified-list'|| $page_status=='reject-list'){
				$header['date_of_application'] = array('data' => 'Date of Application');
				$header['flat_type'] = array('data' => 'Flat Type');
				$header['allotment_category'] = array('data' => 'Allotment Reason');
				$header['computer_serial_no'] = array('data' => 'Computer Serial No');
				$header['approval_or_rejection_date'] = array('data' => 'Approval/Rejection Date');
				$header['Status'] = array('data' => 'Status');
				$header['view'] = array('data' => 'View');
				

			}else{
				$header['date_of_application'] = array('data' => 'Date of Application');
				$header['flat_type'] = array('data' => 'Flat Type');
				$header['allotment_category'] = array('data' => 'Allotment Reason');
				$header['computer_serial_no'] = array('data' => 'Computer Serial No');
				$header['view'] = array('data' => 'View');
				$header['action'] = array('data' => 'Action', 'width'=>'20%');
			}
			/*if($status=='applied'||$status=='ddo_verified_1'||$status=='housing_sup_approved_1'||$status=='alloted'||$status=='applicant_acceptance'||$status=='ddo_verified_2'){
				// echo"i am here";echo $status;
				$header['date_of_application'] = array('data' => 'Date of Application');
				$header['flat_type'] = array('data' => 'Flat Type');
				$header['allotment_category'] = array('data' => 'Allotment Reason');
				$header['computer_serial_no'] = array('data' => 'Computer Serial No');
				$header['view'] = array('data' => 'View');
				$header['action'] = array('data' => 'Action', 'width'=>'20%');
			}else{
				// echo"i am in else";
				$header['date_of_application'] = array('data' => 'Date of Application');
				$header['flat_type'] = array('data' => 'Flat Type');
				$header['allotment_category'] = array('data' => 'Allotment Reason');
				$header['computer_serial_no'] = array('data' => 'Computer Serial No');
				$header['view'] = array('data' => 'View');
			}
			*/
			
		}
		else if($status == 'reject'){
			$header[] = array('data' => 'Reject Date');
		}
		//$header[] = array('data' => 'View');
		
	
		 while($data = $result->fetchObject()) {


			//print_r($data);die;
			$fields = array();
			if($entity == 'new-apply' || $entity == 'vs'||$entity == 'cs' ){
				//echo $page_status;

				if($page_status == 'verified-list'|| $page_status == 'reject-list'){

					$fields[] = $data->applicant_name;
					$fields[] = $data->application_no;
					$fields[] = implode('/', array_reverse(explode('-', $data->date_of_application)));
					$fields[] = $data->flat_type;
					$fields[] = ($data->allotment_category=='')?'Not Applicable':$data->allotment_category;
					$fields[] = ($data->computer_serial_no=='')?'Not Applicable':$data->computer_serial_no;
					$fields[] = $data->created_at;
					$fields[] = $data->status_description;
					global $base_path;
			 		$src=$base_path.drupal_get_path('module', 'view_application_list').'/images/view1.png';
					$fields[] = l(
									'View',
									'application_detail/'.encrypt_url($data->online_application_id).'/'.'verified-list'.'/'.encrypt_url($status), //
									array(
											'html'=>TRUE,
											'attributes'=> array('target' => '_blank','class'=>array('btn bg-primary btn-sm px-5 rounded-pill text-white fw-bolder')),
									)
								);


				}else{

					$fields[] = $data->applicant_name;
					$fields[] = $data->application_no;
					$fields[] = implode('/', array_reverse(explode('-', $data->date_of_application)));
					$fields[] = $data->flat_type;
					$fields[] = ($data->allotment_category=='')?'Not Applicable':$data->allotment_category;
					$fields[] = ($data->computer_serial_no=='')?'Not Applicable':$data->computer_serial_no;
					global $base_path;
			 		$src=$base_path.drupal_get_path('module', 'view_application_list').'/images/view1.png';
					$fields[] = l(
									'View',
									'application_detail/'.encrypt_url($data->online_application_id).'/'.'action-list'.'/'.encrypt_url($status), 
									array(
											'html'=>TRUE,
											'attributes'=> array('target' => '_blank','class'=>array('btn bg-primary btn-sm px-5 rounded-pill text-white fw-bolder')),
									)
								);

					if($status == 'applied') {
						$update_status = 'ddo_verified_1';
						$reject_status = 'ddo_rejected_1';
					}else if($status == 'ddo_verified_1'){
						$update_status = 'housing_sup_approved_1';
						$reject_status = 'housing_sup_reject_1';
					}else if($status == 'allotted'){
						$update_status = 'housing_official_approved';
						$reject_status='housing_official_reject';
					}else if($status == 'applicant_acceptance'){
						$update_status = 'ddo_verified_2';
						$reject_status='ddo_rejected_2';
					}else if($status == 'ddo_verified_2'){
						$update_status = 'housing_sup_approved_2';
						$reject_status='housing_sup_reject_2';
					}


					
					

				

					$onclick="return confirm('Are you sure you want to approve?')";
					$onclick1="return confirm('Are you sure you want to reject?')";
					$fields[] = l(
					'<span class="badge text-bg-success rounded">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
						<path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
						<path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
					</svg></span>' ,

					'application-approve/'.encrypt_url($data->online_application_id).'/'.encrypt_url($update_status).'/'.encrypt_url($status).'/
					'.encrypt_url($entity), array('html'=>TRUE, 'attributes' => array('onclick' => $onclick))).' '.



					l('<span class="badge text-bg-danger rounded"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
					</svg> </span>' ,

					'update_status/'.encrypt_url($data->online_application_id).'/'.encrypt_url($reject_status).'/'.
					encrypt_url($status).'/'.encrypt_url($entity),


					array('html'=>TRUE, 'attributes' => array('onclick' => $onclick1))
				);




				}
			}
				
			$rows[] = $fields;
			  // if()
			  // echo "<pre>";print_r($rows[0][6]);die;
		 }
		
		/*$output = theme_table(
			array(
			  'header' => $header,
			  'rows' => $rows,
			  'attributes' => array(),
			  'sticky' => true,
			  'caption' => '',
			  'colgroups' => array(),
			  'empty' => t("No data found!") // The message to be displayed if table is empty
			)
	  	).theme('pager');*/

		
		// sd 21-06-2024 start
		$variables = array(
			'attributes' => array('class'=>array('table table-list table-striped')),
			'header' => $header,
			'rows' => $rows,
			'sticky' => true,
			'empty' => t("No data found!") // The message to be displayed if table is empty
		  );
  		//end
		//sd turned off 21-06-2024
		if(count($rows) > 0) {
			// Render using Drupal's render API.
			$build['datatable'] = array(
			  '#theme' => 'datatable',
			  '#header' => $header,
			  '#rows' => $rows,
			  '#attributes' => array(),
			);
			
			// Or, render using a theme function.
			$variables = array(
			  'attributes' => array('class'=>array('table table-list')),
			  'header' => $header,
			  'rows' => $rows,
			);
			
			$output = theme('datatable', $variables);
		}
		else {
			$output = '<div>
							<table class="datatable_no_data_found table table-list">
								<tr class="tr_no_data_found">
									<th class="th_no_data_found"></th>
								</tr>
								<tr class="tr_no_data_found">
									<td class="td_no_data_found">No data found!</td>
								</tr>
							</table>
						</div>';
		}
	}
	return $output;
}

