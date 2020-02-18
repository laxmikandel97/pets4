<?php
/**
 * @author Shayna Jamieson, Laxmi Kandel
 * @version 1.0
 * URL: http://sjamieson.greenriverdev.com/328/pets2/index.php
 * Date: January 24, 2020
 */

// start a session - ONLY ever need to put this in our controller (all other pages get by transference)


// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require("vendor/autoload.php");
require_once ('model/validations.php');

session_start();

// instantiate F3
$f3 = Base::instance(); // invoke static

//instantiate the controller
$controller = new PetController($f3);

//set the debug level
$f3->set('DEBUG',3);
$f3->set('colors',array('pink','green','blue'));

// define a default route
// when the user navigates to the route directory of the project
// this is what they should see
$f3->route('GET /', function() {

    $GLOBALS['controller']->home();
});


//define a route accepts animal type parameter
$f3->route('GET /@items', function($f3, $params) {
    $item = $params['items'];
    //use a switch to reroute user OR give them an informed error
    switch ($item){
        case 'chicken':
            echo "<p>Cluck!</p>";
            break;
        case 'dog':
            echo "<p>Woof!</p>";
            break;
        case 'cat':
            echo "<p>Meow!</p>";
            break;
        case 'Goat':
            echo "<p>WHOAAAAAAAAA</p>";
            break;
        case 'Lion':
            echo "<p>Roar</p>";
            break;
        default:
            //no route to send them to, give error
            $f3->error(404);
    }
});

// route to our first page of our order form
// define another route called order that displays a form
$f3->route('GET|POST /order', function($f3) {

    $GLOBALS['controller']->formOne();


});

// route to our second page of our order form
// define another route called order that displays a form
$f3->route('GET|POST /order2', function($f3) {
    $GLOBALS['controller']->formTwo();

});

// route to our results page of our order form
// define another route called order that displays a form
$f3->route('GET|POST /results', function() {
    $GLOBALS['controller']->summary();

});

// fun Fat-Free
$f3->run();