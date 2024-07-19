<?php

	function status_update_page_vs($online_application_id = '', $status = '') {
		global $user;
		$online_id = decrypt_url($online_application_id);
		$accept_reject_status = decrypt_url($status);
		
		$result = fetch_vs_allotment_details();
		$data = $result->fetchObject();
		
		if($accept_reject_status == 'Accept') {
			
			db_update('housing_flat_occupant')
			->fields(array('accept_reject_status' => 'Accept'))
			->condition('online_application_id', $online_id, '=')
			->execute();

			// added by Moumita 26-06-2024
			db_update('housing_online_application')
			->fields(array('status' => 'applicant_acceptance'))
			->condition('online_application_id', $online_id, '=')
			->execute();

			$ins_arr = array(
				'online_application_id'=>$online_id,
				'status_id' => 10,
				'created_at' => date('Y-m-d H:i:s'),
				'uid' => $user->uid,
				'short_code' => 'applicant_acceptance'
			);

			db_insert('housing_process_flow')->fields($ins_arr)->execute();

			
			drupal_set_message('You accepted the allotment.');
			drupal_goto('download-and-upload/'.$online_application_id);

			// drupal_goto('view_vs_allotment_details');
		}
		else if($accept_reject_status == 'Reject'){
			
			db_update('housing_online_application')
			->fields(array('status' => 'applicant_reject'))
			->condition('online_application_id', $online_id, '=')
			->execute();

			$ins_arr = array(
				'online_application_id'=>$online_id,
				'status_id' => 10,
				'created_at' => date('Y-m-d H:i:s'),
				'uid' => $user->uid,
				'short_code' => 'applicant_reject'
			);

			db_insert('housing_process_flow')->fields($ins_arr)->execute();
			
			db_update('housing_flat')
			->fields(array('flat_status_id' => 1))
			->condition('flat_id', $data->flat_id, '=')
			->execute();
			
			//actual old flat
			/*db_update('housing_flat')
			->fields(array('flat_status_id' => 2))
			->condition('flat_id', $data->occupation_flat, '=')
			->execute();*/
			
			db_update('housing_flat_occupant')
			->fields(array('accept_reject_status' => 'Reject'))
			->condition('online_application_id', $online_id, '=')
			->execute();
			
			//db_query('update housing_flat set flat_status_id = 1 where flat_id = '.$data->flat_id);	
			drupal_set_message('You reject the allotment.');
			drupal_goto('view_vs_allotment_details');
		}
	}