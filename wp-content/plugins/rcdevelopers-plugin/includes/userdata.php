<?php
function update_user_data($user_id, $data)
{
    update_if_possible($user_id, 'first_name', $data['first_name']);
    update_if_possible($user_id, 'last_name', $data['last_name']);
    update_if_possible($user_id, 'phone_no', $data['phone_no']);
    update_if_possible($user_id, 'dob', $data['dob']);

    update_if_possible($user_id, 'state', $data['state']);
    update_if_possible($user_id, 'city', $data['city']);
    update_if_possible($user_id, 'business_address', $data['business_address']);
    update_if_possible($user_id, 'residential_address', $data['residential_address']);

    update_if_possible($user_id, 'bank_username', $data['bank_username']);
    update_if_possible($user_id, 'bank_name', $data['bank_name']);
    update_if_possible($user_id, 'branch_name', $data['branch_name']);
    update_if_possible($user_id, 'account_number', $data['account_number']);
    update_if_possible($user_id, 'ifsc_code', $data['ifsc_code']);

    update_if_possible($user_id, 'existing_business', $data['existing_business']);
    update_if_possible($user_id, 'languages', $data['languages']);
    update_if_possible($user_id, 'experience', $data['experience']);

    update_if_possible($user_id, 'linked_code', $data['linked_code']);
    update_if_possible($user_id, 'associate_invite_code', $data['associate']);
    update_if_possible($user_id, 'customer_invite_code', $data['customer']);

    update_if_possible($user_id, 'associate_role', $data['associate_role']);

    update_if_possible($user_id, 'lead_pending', $data['lead_pending']);
    update_if_possible($user_id, 'lead_booked', $data['lead_booked']);
    update_if_possible($user_id, 'lead_confirmed', $data['lead_confirmed']);
    update_if_possible($user_id, 'lead_completed', $data['lead_completed']);

    update_if_possible($user_id, 'date_of_joining',  $data['date_of_joining']);

    update_if_possible($user_id, 'total_earnings', $data['total_earnings']);
    update_if_possible($user_id, 'area_sold', $data['area_sold']);

    user_file_upload($user_id, $data['aadhar_card'], 'aadhar_card');
    user_file_upload($user_id, $data['pan_card'], 'pan_card');
    user_file_upload($user_id, $data['profile_pic'], 'profile_pic');
}

function update_if_possible($user_id, $key, $value)
{
    if ($value) {
        update_user_data($user_id, $key, $value);
    }
}
