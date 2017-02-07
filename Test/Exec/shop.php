#!/usr/bin/env php
<?php
// An example of using php-webdriver.

namespace Facebook\WebDriver;
//namespace 

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('vendor/autoload.php');

// start Firefox with 5 second timeout
$host = 'http://localhost:4444/wd/hub'; // this is the default
//$capabilities = DesiredCapabilities::firefox();
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);


// navigate to 'http://docs.seleniumhq.org/'
$driver->get('https://shop-akukoyashnaya.c9users.io/');
echo "The current URI is'". $driver->getCurrentURL() . "'\n";


//Add to Cart
$link = $driver-> findElement(
	WebDriverBy::id('100001')
	);
$link ->click();
echo "item added\n";
//checkout
$driver->wait(10)->until(
    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
        WebDriverBy::xpath("//a[@href='/checkout']/span")
    )
);
echo "checkout is displayed\n";
$link = $driver -> findElement(
	WebDriverBy::xpath("//a[@href='/checkout']/span")
	);
$link -> click();
//order details wait
$driver->wait(10)->until(
    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
        WebDriverBy::className("to-details")
    )
);
echo "Order details is shown \n";
$link = $driver -> findElement(
	WebDriverBy::className("to-details")
	);
$link -> click();
//wait for client details to display
$driver->wait(10)->until(
    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
        WebDriverBy::className("to-confirm")
    )
);
//fill the form
$login = $driver -> findElement(
	WebDriverBy::xpath("//input[@name = 'fname']")
	) -> sendKeys("John");
$password = $driver -> findElement(
	WebDriverBy::xpath("//input[@name = 'lname']")
	) -> sendKeys("Snow");
$email = $driver -> findElement(
	WebDriverBy::xpath("//input[@name = 'email']")
	) -> sendKeys("john@snow.com");
$phone = $driver -> findElement(
	WebDriverBy::xpath("//input[@name = 'phone']")
	) -> sendKeys("111-22-33");
$zip = $driver -> findElement(
	WebDriverBy::xpath("//input[@name = 'zip']")
	) -> sendKeys("12345");
$address = $driver -> findElement(
	WebDriverBy::xpath("//input[@name = 'address']")
	) -> sendKeys("Baker St, 12/123");

$link = $driver -> findElement(
	WebDriverBy::className("to-confirm")
	) -> click();
 sleep(3);
/*$driver -> wait(10) -> until(
    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
        WebDriverBy::className("place-order")
    )
);*/


$link = $driver -> findElement(
	WebDriverBy::className("place-order")
	);
$link -> click();
	
echo "Order is placed '\n'";
sleep(5);

// adding cookie
/*$driver->manage()->deleteAllCookies();
$driver->manage()->addCookie([
    'name' => 'cookie_name',
    'value' => 'cookie_value',
]);
$cookies = $driver->manage()->getCookies();
print_r($cookies);

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
);
*/
// close the Firefox
$driver->quit();
