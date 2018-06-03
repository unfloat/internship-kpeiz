<?php

return array(

	'pdf' => array(
		'enabled' => true,
		'binary' => base_path('"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"'),
		'timeout' => false,
		'options' => array(),
		'env' => array(),
	),
	'image' => array(
		'enabled' => true,
		'binary' => base_path('/vendor/h4cc/wkhtmltoimage-i386/bin/wkhtmltoimage-i386'),
		'timeout' => false,
		'options' => array(),
		'env' => array(),
	),

);
