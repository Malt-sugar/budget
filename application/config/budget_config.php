<?php

$config['status_active']=1;
$config['status_delete']=0;


//pagination config
$config['view_per_page']=25;
$config['links_per_page']=5;
//pagination config end

//year config
$config['start_year']=2014;
$config['next_year_range']=2;

// Purchase Type
$config['purchase_type_budget'] = 1;
$config['purchase_type_actual'] = 2;

// Sales Prediction Pricing Phase
$config['prediction_phase_initial'] = 1;
$config['prediction_phase_management'] = 2;
$config['prediction_phase_marketing'] = 3;
$config['prediction_phase_final'] = 4;

// MRP
$config['budgeted_mrp_cal_year'] = 3;


// Direction
$config['direction_up'] = 1;
$config['direction_down'] = 2;

// Top Down Assign Type
$config['assign_type_new'] = 1;
$config['assign_type_old'] = 2;

// Month Config
$config['month']['01'] = 'January';
$config['month']['02'] = 'February';
$config['month']['03'] = 'March';
$config['month']['04'] = 'April';
$config['month']['05'] = 'May';
$config['month']['06'] = 'June';
$config['month']['07'] = 'July';
$config['month']['08'] = 'August';
$config['month']['09'] = 'September';
$config['month']['10'] = 'October';
$config['month']['11'] = 'November';
$config['month']['12'] = 'December';

// Pricing Type
$config['pricing_type_automated'] = 1;
$config['pricing_type_initial'] = 2;
$config['pricing_type_marketing'] = 3;
$config['pricing_type_final'] = 4;

// Prediction Years
$config['prediction_years'] = 2;

// Purchase Report Type
$config['purchase_report_type'][1] = 'Budget';
$config['purchase_report_type'][2] = 'Actual';
$config['purchase_report_type'][3] = 'Budget Vs. Actual';

// Pricing Report Type
$config['pricing_report_type'][1] = 'Automated';
$config['pricing_report_type'][2] = 'Management';
$config['pricing_report_type'][3] = 'Marketing';
$config['pricing_report_type'][4] = 'Final';
$config['pricing_report_type'][5] = 'Comparison';
$config['pricing_report_type'][6] = 'Budget Vs. Actual';
$config['pricing_report_type'][7] = 'Final Prediction Pricing';

// Pricing Comparison Type
$config['pricing_report_comparison'][1] = 'Commission';
$config['pricing_report_comparison'][2] = 'Bonus';
$config['pricing_report_comparison'][3] = 'Incentive';
$config['pricing_report_comparison'][4] = 'Net Profit';
$config['pricing_report_comparison'][5] = 'Net Sales Price';
$config['pricing_report_comparison'][6] = 'Total Net Profit';
$config['pricing_report_comparison'][7] = 'Total Net Sales Price';