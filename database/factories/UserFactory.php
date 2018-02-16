<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Profile::class, function (Faker $faker) {
    return [
    	'customer_id' => $faker->name,
    	'employee_id' => $faker->name,
        'name' => $faker->name,
        'designation' => $faker->name,
        'email_id' => $faker->unique()->safeEmail,
        'phone_number' => $faker->e164PhoneNumber,
        'address' => $faker->name,
        'gender' => $faker->name,
        'profile_pic' => $faker->image,
        
        
    ];
});
$factory->define(App\CcRefund::class, function (Faker $faker) {
    return [
    	'customer_id' => $faker->name,
    	'customer_name' => $faker->name,
        'account_no' => $faker->name,
        'ifsc_no' => $faker->unique()->randomNumber(6),
        'bank' => $faker->name,
        'branch' => $faker->name,
        'reason' => $faker->sentence(),
        'refund_amount' => $faker->randomNumber(9),
        'mail_date' => $faker->dateTimeThisMonth($max = 'now'),
        'refund_status' => $faker->randomLetter,
        'done_date' => $faker->dateTimeThisMonth($max = 'now'),
        'utr_no' => $faker->randomNumber(),
        'assigned_to' => $faker->name,
        'generated_by' => $faker->name,
        
    ];
});
$factory->define(App\CcExtension::class, function (Faker $faker) {
    return [
    	'customer_id' => $faker->name,
    	'complaint_date' => $faker->dateTimeThisMonth($max = 'now'),
        'expiry_date' => $faker->name,
        'status' => $faker->randomLetter(),
        'reason' => $faker->unique()->sentence(),
        'assigned_to' => $faker->name,
        'extension_day' => $faker->randomNumber(3),
        'generated_by' => $faker->name,
        
        
    ];
});
$factory->define(App\CcDownArea::class, function (Faker $faker) {
    return [
    	'area' => $faker->city,
    	'assigned_to' => $faker->name,
        'reason' => $faker->sentence(),
         'down_day_time' => $faker->dateTimeThisMonth($max = 'now'),
        'up_day_time' => $faker->unique()->dateTimeThisMonth($max = 'now'),
         'generated_by' => $faker->name,
        
        
    ];
});
$factory->define(App\CcFeasibleArea::class, function (Faker $faker) {
    return [
        'reseller_name' => $faker->name,
        'building' => $faker->city,
        'society' => $faker->city,
		'area' => $faker->city,
		'city' => $faker->city,
		'switch_location' => $faker->city,
		'contact_person_name' => $faker->name,
		'contact_person_no' => $faker->e164PhoneNumber,
		'generated_by' => $faker->name,
];
});










$factory->define(App\HrManpower::class, function (Faker $faker) {
    return [
    	'vacancy_designation' => $faker->name,
    	'no_of_vacancy' => $faker->randomNumber,
        'reason' => $faker->name,
        'priority' => $faker->name,
        'preferences' => $faker->unique()->sentence(),
        'qualification' => $faker->sentence(),
        'status' => $faker->randomLetter,
        'comment' => $faker->sentence(),
        'job_description' => $faker->sentence(),
        'generated_by' => $faker->name,
        
        
    ];
});
$factory->define(App\HrStationery::class, function (Faker $faker) {
    return [
    'item_description' => $faker->name,
    'quantity' => $faker->randomNumber,
    'reason' => $faker->sentence(),
    'status' => $faker->randomLetter,
    'comment' => $faker->sentence(),
    'generated_by' => $faker->name,
     ];
});
$factory->define(App\SalesIll::class, function (Faker $faker) {
    return [
    'customer_name' => $faker->name,
    'customer_address' => $faker->city,
    'customer_city' => $faker->randomElement(['pune', 'kolhapur', 'nagpur', 'mumbai', 'surat', 'ahemadabad', 'vapi', 'bhopal', 'indore', 'gorakhpur']),
    'customer_state' => $faker->name,
    'pincode' => $faker->randomNumber,
    'contact_person_name' => $faker->name,
    'contact_person_no' => $faker->e164PhoneNumber,
    'contact_person_email' => $faker->safeEmail,
    'bandwidth_size' => $faker->name,
    'feasibility_status' => $faker->name,
    'fiber' => $faker->randomNumber(4),
    'rf' => $faker->randomNumber(4),
    'generated_by' => $faker->name,
    
     ];
});
$factory->define(App\SalesP2p::class, function (Faker $faker) {
    return [
    'product_name' => $faker->randomNumber,
    'customer_name' => $faker->name,
    'contact_person_name' => $faker->name,
    'contact_person_no' => $faker->e164PhoneNumber,
    'contact_person_email' => $faker->safeEmail,
    'a_end_address' => $faker->city,
    'a_end_city' => $faker->randomElement(['pune', 'kolhapur', 'nagpur', 'mumbai', 'surat', 'ahemadabad', 'vapi', 'bhopal', 'indore', 'gorakhpur']),
    'a_end_state' => $faker->state,
    'a_end_pincode' => $faker->randomNumber(6),
    'a_end_lat_long' => $faker->randomNumber,
    'b_end_address' => $faker->city,
    'b_end_city' => $faker->randomElement(['pune', 'kolhapur', 'nagpur', 'mumbai', 'surat', 'ahemadabad', 'vapi', 'bhopal', 'indore', 'gorakhpur']),
    'b_end_state' => $faker->state,
    'b_end_pincode' => $faker->randomNumber(6),
    'b_end_lat_long' => $faker->randomNumber,
    'network_priority' => $faker->name,
    'feasibility_status' => $faker->randomLetter,
    'a_end_feasibility' => $faker->name,
    'b_end_feasibility' => $faker->name,
    'bts_address' => $faker->city,

    'generated_by' => $faker->name,
    
     ];
});
$factory->define(App\SalesApprovalNote::class, function (Faker $faker) {
    return [
    'customer_name' => $faker->name,
    'bandwidth_size' => $faker->name,
    'order_value' => $faker->randomNumber,
    'job_id' => $faker->randomNumber(7),
    'capex' => $faker->name,
    'opex' => $faker->name,
    'operator_involved' => $faker->name,
    'miscellaneous_expenses' => $faker->name,
    'approved_by_hod' => $faker->name,
    'approved_by_ceo' => $faker->name,
    'approval_remark' => $faker->name,
    'generated_by' => $faker->name,
  
     ];
});
$factory->define(App\Voip::class, function (Faker $faker) {
    return [
    'dates_manually' => $faker->dateTimeThisMonth($max = 'now'),
    'destination' => $faker->name,
    'country_code' => $faker->countrycode,
    'area_code' => $faker->randomNumber(9),
    'price' => $faker->randomNumber(9),
    'status' => $faker->randomLetter,
    'generated_by' => $faker->name,
   
     ];
});
$factory->define(App\DocumentApproval::class, function (Faker $faker) {
    return [
    'title' => $faker->name,
    'file_path' => $faker->name,
    'remark' => $faker->sentence(),
    'level1_approval' => $faker->name,
    'level2_approval' => $faker->name,
    'level3_approval' => $faker->name,
    'job_id' => $faker->randomNumber,
    'priority' => $faker->name,
    'deadline' => $faker->name,
    'generated_by' => $faker->name,
   
     ];
});
$factory->define(App\Inventory::class, function (Faker $faker) {
    return [
    'vendor_name' => $faker->name, 
    'vendor_address' => $faker->city,
    'vendor_email' => $faker->safeEmail,
    'date' => $faker->dateTimeThisMonth($max = 'now'),
    'purchase_order_no' => $faker->randomNumber,
    'from_dept' => $faker->name,
    'purchase_requisition_no' => $faker->randomNumber,
    'quotation_dept' => $faker->name,
    'quotation_reference_no' => $faker->randomNumber,
    'ship_to' => $faker->name,
    'good_description' => $faker->name,
    'unit' => $faker->randomNumber,
    'quantity' => $faker->randomNumber,
    'unit_price' => $faker->randomNumber,
    'amount' => $faker->randomNumber, 
    'total_rs' => $faker->randomNumber,
    'payment_terms' => $faker->randomNumber,
    'validity_of_purchase_order' => $faker->name,
    'date_of_expiry' => $faker->dateTimeThisMonth($max = 'now'),
    'generated_by' => $faker->name,
    ];
});