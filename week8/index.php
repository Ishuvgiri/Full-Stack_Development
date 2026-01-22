<?php
require 'vendor/autoload.php';
require 'app/controller/employee_controller.php';
use Jenssegers\Blade\Blade;
$blade = new Blade('app/views', 'cache');
$data = handleEmployeeRequest();
echo $blade->render($data['view'], $data);