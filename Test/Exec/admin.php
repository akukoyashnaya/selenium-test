#!/usr/bin/env php
<?php

// An example of using php-webdriver.

namespace Test;

require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Test\Model\Admin;


// start Firefox with 5 second timeout
$host = 'http://localhost:4444/wd/hub'; // this is the default
//$capabilities = DesiredCapabilities::firefox();
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);


// navigate to 'http://docs.seleniumhq.org/'
$driver->get('https://shop-akukoyashnaya.c9users.io/admin');
echo "The initial URI is '" . $driver->getCurrentURL() . "'\n";
//\Test\Model\
Model\Admin::Login($driver,'admin','admin');die("EURIKA!");

/*
$login=$driver->findElement(
	WebDriverBy::className('login')
	);
$login->sendKeys('admin');

$password = $driver->findElement(
	WebDriverBy::className('password')
	);
$password -> sendKeys('admin');

$driver -> findElement(
	WebDriverBy::className('submit')
	)->submit();
*/
//echo "The login is '" .$login->get."'\n";
$driver->wait(10, 500)->until(function ($driver) {
	 return $driver->getCurrentURL() === 'https://shop-akukoyashnaya.c9users.io/admin/orders';
});

echo "The URI after login is '" . $driver->getCurrentURL() . "'\n";
///////
//count orders
/*
$orders_qty = $driver -> findElement(
	WebDriverBy::xpath("//table[@id='admin-orders']/tbody/tr")
	);  
print_r($orders_qty);
*/
$orders_qty = count($driver -> findElements(
	WebDriverBy::xpath("//table[@id='admin-orders']/tbody/tr")));  
echo "The number of orders is '".$orders_qty."'\n";

/*
// click the link 'About'
$link = $driver->findElement(
	WebDriverBy::id('menu_about')
);
$link->click();

// print the title of the current page
echo "The title is '" . $driver->getTitle() . "'\n";

// print the URI of the current page
echo "The current URI is '" . $driver->getCurrentURL() . "'\n";

// Search 'php' in the search box
$input = $driver->findElement(
	WebDriverBy::id('q')
);
$input->sendKeys('php')->submit();

// wait at most 10 seconds until at least one result is shown
$driver->wait(10)->until(
	WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
		WebDriverBy::className('gsc-result')
	)
);*/

// close the Firefox
$driver->quit();
