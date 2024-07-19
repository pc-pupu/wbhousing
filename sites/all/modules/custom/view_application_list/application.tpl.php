<?php 
global $base_root, $base_path, $user_role;
//echo "<pre>";print_r($output);die;
if(isset($output['page_status'])){
	$page_status=$output['page_status'];
}else{
	$page_status=null;
}
//print_r($output);die;
$url = decrypt_url($output['url']); //echo $url; die('yyyy');
$status = $output['status'];
$options['attributes']['class'] = array('button','link-button','round','child-tab','child-color-blue');
$options['html'] = TRUE;
$options1['attributes']['class'] = array('button','link-button','round','child-tab','child-color-sea');
$options1['html'] = TRUE;
if($status == 'applied'){
	drupal_set_title('New Application List');
}
else if($status == 'ddo_verified_1'||$status == 'ddo_verified_2'||$status=='housing_sup_approved_1'||$status=='housing_official_approved'||$status=='housing_sup_approved_2'){
	drupal_set_title('Verified Application List');
}
else if($status == 'ddo_rejected_1'||$status == 'ddo_rejected_2'||$status=='housing_sup_reject_1'||$status=='housing_official_rejected'||$status=='housing_sup_reject_2'){
	drupal_set_title('Rejected Application List');
}

if($user_role == 11 && $status == 'applied'){
	$new_status = 'applied';
	$next_status_app = 'ddo_verified_1';
	$next_status_rej = 'ddo_rejected_1';

}else if($user_role == 11 && $status == 'applicant_acceptance'){
	$new_status = 'applicant_acceptance';
	$next_status_app = 'ddo_verified_2';
	$next_status_rej = 'ddo_rejected_2';

}else if($user_role == 10 && $status == 'ddo_verified_1'){
	$new_status = 'ddo_verified_1';
	$next_status_app = 'housing_sup_approved_1';
	$next_status_rej = 'housing_sup_reject_1';

}else if($user_role == 10 && $status == 'ddo_verified_2'){
	$new_status = 'ddo_verified_2';
	$next_status_app = 'housing_sup_approved_2';
	$next_status_rej = 'housing_sup_reject_2';

}else if($user_role == 6){
	$new_status = 'allotted';
	$next_status_app = 'housing_official_approved';
	$next_status_rej = 'housing_official_reject';
}




?>

<div class="row mt-4">
	<div class="col-md-4">
		<div class="counter-box p-3 rounded mb-3 position-relative">
			<?php if($url=='new-apply'){?>
				<span class="counter"><?=$output['new-apply'] ?></span>
			<?php }elseif($url=='vs'){?>
				<span class="counter"><?=$output['vs'] ?></span>
			<?php }elseif($url=='cs'){?>
				<span class="counter"><?=$output['cs'] ?></span>
			<?php }?>	
			<p>Action List</p>
			<a href="<?= $base_root.$base_path.'view_application/'.encrypt_url($status).'/'.encrypt_url($url).'/action-list' ?>" class="badge rounded-pill text-bg-success">View Details</a>
			<img src="<?= $base_root.$base_path ?>sites/all/themes/housingtheme/images/allotment-icon.png" class="position-absolute end-0 counter-box-icon top-0" />
		</div>
	</div>
	<div class="col-md-4">
		<div class="counter-box p-3 rounded mb-3 position-relative">
			<i class="fa fa-group"></i>
			<?php if($url=='new-apply'){?>
				<span class="counter"><?=$output['new-apply-verified'] ?></span>
			<?php }elseif($url=='vs'){?>
				<span class="counter"><?=$output['vs-verified'] ?></span>
			<?php }elseif($url=='cs'){?>
				<span class="counter"><?=$output['cs-verified'] ?></span>
			<?php }?>	
			<p>Verified List</p>
			<a href="<?= $base_root.$base_path.'view_application/'.encrypt_url($next_status_app).'/'.encrypt_url($url).'/'.'verified-list' ?>" class="badge rounded-pill text-bg-success">View Details</a>
			<img src="<?= $base_root.$base_path ?>sites/all/themes/housingtheme/images/floor-icon.png" class="position-absolute end-0 counter-box-icon top-0" />
		</div>
	</div>
	<div class="col-md-4">
		<div class="counter-box p-3 rounded mb-3 position-relative">
			<i class="fa  fa-shopping-cart"></i>
			<?php if($url=='new-apply'){?>
				<span class="counter"><?=$output['new-apply-rejected'] ?></span>
			<?php }elseif($url=='vs'){?>
				<span class="counter"><?=$output['vs-rejected'] ?></span>
			<?php }elseif($url=='cs'){?>
				<span class="counter"><?=$output['cs-rejected'] ?></span>
			<?php }?>
			<p>Rejected List</p>
			<?php
				// $enc= encrypt_url($next_status_rej); 
				// $dec= decrypt_url($enc);
				//print(encrypt_url($next_status_rej));//print($dec);die;
			?>
			<a href="<?= $base_root.$base_path.'view_application/'.encrypt_url($next_status_rej).'/'.encrypt_url($url).'/'.'reject-list' ?>" class="badge rounded-pill text-bg-success">View Details</a>
			<img src="<?= $base_root.$base_path ?>sites/all/themes/housingtheme/images/allotment-icon.png" class="position-absolute end-0 counter-box-icon top-0" />
		</div>
	</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>