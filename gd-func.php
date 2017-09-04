<?php
// Gradient Descent in PHP
// An implementation of https://github.com/llSourcell/GradientDescentExample

define('LEARNING_RATE', 0.0001);
define('BIAS', 0);
define('SLOPE', 0);
define('ITERATIONS', 1000);

// Generate two columns random numbers
$column_x = $column_y = array();

$f = fopen('data.csv', 'r');
while(($data = fgetcsv($f)) !== FALSE){
	$column_x[] = $data[0];
	$column_y[] = $data[1];
}
fclose($f);

$error = compute_error_for_line_given_points(BIAS, SLOPE, $column_x, $column_y);
printf("Starting gradient descent at b = %s, m = %s, error = %s<br/>", BIAS, SLOPE, $error);

print("Running...<br/>");
list($current_bias, $current_slope) = run_gradient_descent($column_x, $column_y, BIAS, SLOPE, LEARNING_RATE, ITERATIONS);

$error = compute_error_for_line_given_points($current_bias, $current_slope, $column_x, $column_y);
printf("After %s iterations b = %s, m = %s, error = %s", ITERATIONS, $current_bias, $current_slope, $error);

function compute_error_for_line_given_points($bias, $m, $column_x, $column_y){
    $totalError = 0;

    $c = count($column_x);

    for($i = 0; $i < $c; $i++){
        $x = $column_x[$i];
        $y = $column_y[$i];
        $totalError += ($y - ($m * $x + $b)) ** 2;
    }

    return $totalError / $c;
}

function run_gradient_descent($column_x, $column_y, $bias, $slope, $learning_rate, $iterations){
    $b = $bias;
    $m = $slope;
    for($i = 0; $i < $iterations; $i++){
        list($b, $m) = step_gradient($b, $m, $column_x, $column_y, $learning_rate);
    }
    return array($b, $m);
}

function step_gradient($b_current, $m_current, $column_x, $column_y, $learning_rate){
    $b_gradient = 0;
    $m_gradient = 0;

    $N = count($column_x);

    for($i = 0; $i < $N; $i++){
        $x = $column_x[$i];
        $y = $column_y[$i];
        $b_gradient += -(2/$N) * ($y - (($m_current * $x) + $b_current));
        $m_gradient += -(2/$N) * ($y - (($m_current * $x) + $b_current)) * $x;
    }

    $new_b = $b_current - ($learning_rate * $b_gradient);
    $new_m = $m_current - ($learning_rate * $m_gradient);

    return array($new_b, $new_m);
}