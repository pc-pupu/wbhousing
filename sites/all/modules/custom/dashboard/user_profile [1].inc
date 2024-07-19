<!-- Done by Subham 21/06/2024 & 24/06/2024 & 25/06/2024 -->
<?php
function user_profile_form($form, &$form_state) {
    global $user;

    // $user_info = getApplicantInfo();
    $get_hrms_data = getHRMSUserData($user->name);
    // print_r($get_hrms_data);die;

    //Fetching Flat details
    $query ='SELECT he.estate_name,he.estate_address, hft.flat_type, hf.floor, hf.flat_no
                FROM housing_online_application hoa
                INNER JOIN housing_applicant_official_detail haod ON haod.applicant_official_detail_id = hoa.applicant_official_detail_id
                INNER JOIN housing_flat_occupant hfo ON hfo.online_application_id = hoa.online_application_id
                INNER JOIN housing_flat hf ON hf.flat_id = hfo.flat_id
                INNER JOIN housing_estate he ON he.estate_id = hf.estate_id
                INNER JOIN housing_flat_type hft ON hft.flat_type_id = hf.flat_type_id
                WHERE haod.uid = '.$user->uid.''; 
    $result = db_query($query);
    $result = $result->fetchAssoc();

    //Concatenation of permanent address related all filds into a variable 
    $permanent_address_from_hrms = $get_hrms_data['permanentStreet'].', '.$get_hrms_data['permanentCityTownVillage'].', '.$get_hrms_data['permanentPostOffice'];

    //Pushing all rows of  $permanent_address_from_hrms into a blank array
    $permanent_address_from_hrms_parts = array(
        $get_hrms_data['permanentStreet'],
        $get_hrms_data['permanentCityTownVillage'],
        $get_hrms_data['permanentPostOffice']
    );

    //For filter-out blank rows
    $permanent_address_from_hrms_parts = array_filter($permanent_address_from_hrms_parts);

    // Construct the permanent address string
    $permanent_address = implode(', ', $permanent_address_from_hrms_parts);

    $office_address_from_hrms = $get_hrms_data['officeStreetCharacter'].', '.$get_hrms_data['officePinCode'];

    //Pushing all rows of  $office_address into a blank array
    $office_address_from_hrms_parts = array(
        $get_hrms_data['officeStreetCharacter'],
        $get_hrms_data['officePinCode']
    );

    //Fetching DDO details
    $query1 = "SELECT ddo.ddo_designation, ddo.ddo_address, ddo.ddo_code, ht.treasury_name
                FROM housing_ddo ddo 
                INNER JOIN housing_treasury ht ON ht.treasury_id = ddo.treasury_id
                WHERE ddo_code = '" . $get_hrms_data['ddoId'] . "' AND ddo.is_active = 'Y'";

    $result1 = db_query($query1);
    $result1 = $result1->fetchAssoc();


    //For filter-out blank rows
    $office_address_from_hrms_parts = array_filter($office_address_from_hrms_parts);

    // Construct the office address string
    $office_address = implode(', ', $office_address_from_hrms_parts);

        $output = '<div class="user-profile">
        <div class="row">
            <div class="blockquote text-right">
                <h3>Your Personal Details</h3>
                <div class="row">
                    <div class="col-md-6"><b>Name: </b>'.ucwords(strtolower($get_hrms_data['applicantName'])).'</div>
                    <div class="col-md-6"><b>Guardian Name: </b>' .(isset($user_info['guardian_name']) ? ucwords(strtolower($user_info['guardian_name'])) : (isset($get_hrms_data['guardianName']) ? ucwords(strtolower($get_hrms_data['guardianName'])) : 'N/A')).'</div>
                    <div class="col-md-6"><b>Permanent Address:</b> '.(!empty($permanent_address) ? $permanent_address : 'N/A').'</div>
                </div>
            </div>
            <div class="blockquote text-right">
                <h3>Your Contact Details</h3>
                <div class="row">
                    <div class="col-md-6"><b>Mobile Number: </b>'.(isset($user_info['mobile_no']) ? $user_info['mobile_no'] : (isset($get_hrms_data['mobileNo']) ? $get_hrms_data['mobileNo'] : 'N/A')) .'</div>
                    <div class="col-md-6"><b>Email: </b>'. (isset($user->mail) ? $user->mail : isset($get_hrms_data['email']) ? $get_hrms_data['email'] : 'N/A').'</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blockquote text-right">
                <h3>Your Office Details</h3>
                <div class="row">
                    <div class="col-md-6"><b>Designation: </b>' . (!empty($get_hrms_data['applicantDesignation']) ?$get_hrms_data['applicantDesignation'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Date of Joining: </b>' . (!empty($get_hrms_data['dateOfJoining']) ?$get_hrms_data['dateOfJoining'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Date of Retirement: </b>' . (!empty($get_hrms_data['dateOfRetirement']) ?$get_hrms_data['dateOfRetirement'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Department Name:</b> '.ucwords(strtolower(isset($user_info['office_name']) ? $user_info['office_name'] : $get_hrms_data['officeName'])) .'</div>
                    <div class="col-md-6"><b>Office Address:</b> ' . (!empty($office_address) ? $office_address : 'N/A') . '</div>
                    <div class="col-md-6"><b>Office Headquarter:</b> ' . (!empty($get_hrms_data['applicantHeadquarter']) ?$get_hrms_data['applicantHeadquarter'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Posting Place:</b> ' . (!empty($get_hrms_data['applicantPostingPlace']) ?$get_hrms_data['applicantPostingPlace'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Grade Pay: </b>' . (!empty($get_hrms_data['gradePay']) ?$get_hrms_data['gradePay'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Pay Band: </b>' . (!empty($get_hrms_data['payInThePayBand']) ?$get_hrms_data['payInThePayBand'] : 'N/A') . '</div>
                </div>
            <div class="blockquote text-right">
                <h3>DDO Details</h3>
                <div class = "row">
                    <div class="col-md-6"><b>Treasury Name:</b> ' . (isset($result1['treasury_name']) ? $result1['treasury_name'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>DDO Designation:</b> ' . (isset($result1['ddo_designation']) ? $result1['ddo_designation'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>DDO Address:</b> ' . (isset($result1['ddo_address']) ? $result1['ddo_address'] : 'N/A') . '</div>
                </div>
            </div>
            <div class="blockquote text-right">
                <h3>Your Housing Details</h3>
                <div class="row">
                    <div class="col-md-6"><b>Housing Estate Name:</b> ' . (isset($result['estate_name']) ? $result['estate_name'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Housing Estate Address:</b> ' . (isset($result['estate_address']) ? $result['estate_address'] : 'N/A').'</div>
                    <div class="col-md-6"><b>Housing Estate Type:</b> ' . (isset($result['flat_type']) ? $result['flat_type'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Floor: </b> ' . (isset($result['floor']) ? $result['floor'] : 'N/A') . '</div>
                    <div class="col-md-6"><b>Flat Number: </b> ' . (isset($result['flat_no']) ? $result['flat_no'] : 'N/A') . '</div>
                </div>
            </div>
        </div>
    </div>';

    $form['markup_data'] = array(
    '#type' => 'markup',
    '#markup' => $output
    );

    return $form;
}