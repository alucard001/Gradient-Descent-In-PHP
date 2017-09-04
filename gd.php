<?php
// Gradient Descent in PHP
// An implementation of https://github.com/llSourcell/GradientDescentExample

define('LEARNING_RATE', 0.0001);
define('BIAS', 0);
define('SLOPE', 0);
define('ITERATIONS', 1000);

// Read data from data.csv
$column_x = $column_y = array();

$f = fopen('data.csv', 'r');
while(($data = fgetcsv($f)) !== FALSE){
	$column_x[] = $data[0];
	$column_y[] = $data[1];
}
fclose($f);

// run_gradient_descent()
$error = compute_error_for_line_given_points(BIAS, SLOPE, $column_x, $column_y);
printf("Starting gradient descent at b = %s, m = %s, error = %s<br/>", BIAS, SLOPE, $error);

print("Running...<br/>");

// Set initial Bias (b) and slope (m)
$b = BIAS;
$m = SLOPE;

// Count the total rows in datasets, column_x and y has the same count
$num_data_rows = count($column_x);

// Start iteration
for($i = 0; $i < ITERATIONS; $i++){
    $_b = 0;	// bias used in internal loop/iterations
    $_m = 0;	// slope value used in internal loop/iterations

    // For each iteration, we loop over the whole dataset, and find the total internal bias($_b) and slope($_m)
    for($j = 0; $j < $num_data_rows; $j++){
        $x_value = $column_x[$j];
        $y_vlaue = $column_y[$j];

        // Use slope-intercept formula: y = m*x + b => y - (m*x + b)
        $_b += -(2/$num_data_rows) * ($y_vlaue - (($m * $x_value) + $b));
        $_m += -(2/$num_data_rows) * ($y_vlaue - (($m * $x_value) + $b)) * $x_value;
    }

    // Back propagation - update the slope($m) and bias ($b)
    // Then use this value to start the next iteration
    $b = $b - (LEARNING_RATE * $_b);
    $m = $m - (LEARNING_RATE * $_m);
}

// Finally we get the outcome of  the slope($m) and bias ($b)
$current_bias = $b;
$current_slope = $m;

// The outcome is the same as example
$error = compute_error_for_line_given_points($current_bias, $current_slope, $column_x, $column_y);
printf("After %s iterations b = %s, m = %s, error = %s", ITERATIONS, $current_bias, $current_slope, $error);

function compute_error_for_line_given_points($bias, $m, $column_x, $column_y){
    $totalError = 0;

    $num_data_rows = count($column_x);

    for($i = 0; $i < $num_data_rows; $i++){
        $x = $column_x[$i];
        $y = $column_y[$i];
        // The reason to square (** 2) is to make any negative (-) value to be positive (+)
        $totalError += ($y - ($m * $x + $b)) ** 2;
    }

    return $totalError / $num_data_rows;
}