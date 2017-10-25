<?php

// Load composer autoload file
require_once __DIR__ . '/vendor/autoload.php';

use src\Trip;

// ## Uncomment the below lines for Mannual 
// $boardingCollection = array(
//     array(
//         'Departure' => 'C',
//         'Arrival' => 'D',
//         'Transportation' => 'Bus',
//     ),
//     array(
//         'Departure' => 'A',
//         'Arrival' => 'B',
//         'Transportation' => 'Train',
//         'TransportationNumber' => '78A',
//         'Seat' => '45B',
//     )
// );
//
// $trip = new Trip($boardingCollection);
//
// // Add another boarding If you want to testing
// $trip->addBoarding(array(
//     'Departure' => 'B',
//     'Arrival' => 'C',
//     'Transportation' => 'Plane',
//     'TransportationNumber' => '11A',
//     'Seat' => '10A',
//     'Gate' => '10A',
// ));

// ## Including card file to access borading collection from file 
include_once('card.php');
$trip = new Trip($boardingCollection);

// Lets Sort it
$trip->sort();

// Function to display
$trip->tripString();
