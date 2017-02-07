<?php
namespace Test\Model;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver;

class Admin {
public static function Login($driver, $login, $password){
	$driver->findElement(
		\Facebook\WebDriver\WebDriverBy::className('login')
		) ->sendKeys($login);
	

	$driver->findElement(
		\Facebook\WebDriver\WebDriverBy::className('password')
		)-> sendKeys($password);

	$driver -> findElement(
		\Facebook\WebDriver\WebDriverBy::className('submit')
		)->submit();
//echo "The login is '" .$login->get."'\n";
	$driver->wait(10, 500)->until(function ($driver) {
	 	return $driver->getCurrentURL() === 'https://shop-akukoyashnaya.c9users.io/admin/orders';
		});
	}
}
public static function compare_orders_and_db($db,$oders_qty)
{
	$dddb
}