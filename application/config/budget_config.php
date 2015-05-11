<?php

$config['status_active']=1;
$config['status_delete']=0;


//pagination config
$config['view_per_page']=100;
$config['links_per_page']=5;
//pagination config end

//15 days common config
$config['default_number_of_fifteen_days'] = 3;
$config['max_number_of_fifteen_days'] = 12;
$config['day_interval_15'] = 15;//hard coded at setup_image_15days need to check controller view and model to fix
//15 days common config end

//15 days text config
//crop fruit type config
$config['fruit_type'][1] = 'Fruit';
$config['fruit_type'][2] = 'Curd';
$config['fruit_type'][3] = 'Root';
$config['fruit_type'][4] = 'Leaf';
$config['fruit_type'][5] = 'Head';

//rating config
$config['rating'][3] = 3; // 'Poor';
$config['rating'][4] = 4; // 'Below Average';
$config['rating'][5] = 5; // 'Average';
$config['rating'][6] = 6; // 'Good';
$config['rating'][7] = 7; // 'Excellent';


$config['rating_label'][7] = 'Excellent';
$config['rating_label'][6] = 'Good';
$config['rating_label'][5] = 'Average';
$config['rating_label'][4] = 'Below Average';
$config['rating_label'][3] = 'Poor';

$config['trial_status'][1] = 'Retrial';
$config['trial_status'][2] = 'Reject';

$config['curd_Type_rating'][1] = 'Dome';
$config['curd_Type_rating'][2] = 'Semi-Dome';

$config['head_Type_rating'][1] = 'Round';
$config['head_Type_rating'][2] = 'Semi-Flat';
$config['head_Type_rating'][3] = 'Flat';

$config['root_Type_rating'][1] = 'Single';
$config['root_Type_rating'][2] = 'Auxiliary';

$config['leaf_Type_rating'][1] = 'Cherated';
$config['leaf_Type_rating'][2] = 'Partially Cherated';

$config['spine_type_rating'][1] = 'Blunt';
$config['spine_type_rating'][2] = 'Semi-Blunt';
$config['spine_type_rating'][3] = 'Pointed';
//15 days text config end


//year config
$config['start_year']=2014;
$config['next_year_range']=2;

//variety type config
$config['variety_type'][1] = 'PRINCIPAL';
$config['variety_type'][2] = 'CKA';
$config['variety_type'][3] = 'CKO';



//config for file upload and directory
$config['max_file_size'] = 1024*10;
$config['dir']['15_days_image_config'] = 'images/15_days_image_config';
$config['dir']['15_days_image_data'] = 'images/15_days_image_data';

$config['dir']['flowering_image_config'] = 'images/flowering_image_config';
$config['dir']['flowering_image_data'] = 'images/flowering_image_data';


$config['dir']['fruit_image_config'] = 'images/fruit_image_config';
$config['dir']['fruit_image_data'] = 'images/fruit_image_data';

$config['dir']['harvest_cropwise_image_config'] = 'images/harvest cropwise_image_config';
$config['dir']['harvest_cropwise_image_data'] = 'images/harvest cropwise_image_data';

// Flowering Config
$config['flowering_image'][1]='1st Flowering Pic';
$config['flowering_image'][2]='50% Flowering Pic';
$config['flowering_image'][3]='1st Fruit Setting Pic';
$config['flowering_image'][4]='1st Harvested Fruit';
$config['flowering_image'][5]='Last Harvested Fruit';
$config['flowering_image'][6]='Special Characters';

//setup fruit config
$config['fruit_image'][1]='Plot Picture';
$config['fruit_image'][2]='Plant Picture';
$config['fruit_image'][3]='Close %s Picture';
$config['fruit_image'][4]='Single %s Picture 1';
$config['fruit_image'][5]='Single %s Picture 2';
$config['fruit_image'][6]='Several %s Picture 1';
$config['fruit_image'][7]='Several %s Picture 2';
$config['fruit_image'][8]='cut %s Picture 1';
$config['fruit_image'][9]='cut %s Picture 2';
$config['fruit_image'][10]='cut %s Picture 3';

// setup hervest cropwise Config
$config['harvest_cropwise_image'][1]='Harvested Normal Fruit';
$config['harvest_cropwise_image'][2]='Harvested Abnormal Fruit';


// Keeping Quality
$config['keeping_quality'][1]='Good';
$config['keeping_quality'][2]='Average';
$config['keeping_quality'][3]='Poor';

//fix bellow config latter

$config['stock_history_report_type'][1]='Stock In';
$config['stock_history_report_type'][2]='Stock Out';
$config['stock_history_report_type'][3]='Inventory Stock In';
$config['stock_history_report_type'][4]='Inventory Stock Out';




