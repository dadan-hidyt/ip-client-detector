<?php

use DadanDev\IPDetector\UserIPDetector;

include 'vendor/autoload.php';

$vendor = new UserIPDetector;

var_dump($vendor->getIpCountry("180.244.139.149"));