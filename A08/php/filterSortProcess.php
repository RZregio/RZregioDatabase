<?php
$flightQuery = "SELECT * FROM flightlogs";
$conditions = [];
$orderBy = "";


// Filters
if (isset($_GET['airline']) && $_GET['airline'] !== '') {
    $airline = $_GET['airline'];
    $conditions[] = "airlineName = '$airline'";
}

if (isset($_GET['aircraft']) && $_GET['aircraft'] !== '') {
    $aircraft = $_GET['aircraft'];
    $conditions[] = "aircraftType = '$aircraft'";
}

if (isset($_GET['departure']) && $_GET['departure'] !== '') {
    $departure = $_GET['departure'];
    $conditions[] = "departureAirportCode = '$departure'";
}

if (isset($_GET['arrival']) && $_GET['arrival'] !== '') {
    $arrival = $_GET['arrival'];
    $conditions[] = "arrivalAirportCode = '$arrival'";
}

if (isset($_GET['creditcard']) && $_GET['creditcard'] !== '') {
    $creditcard = $_GET['creditcard'];
    $conditions[] = "creditCardType = '$creditcard'";
}

if (!empty($conditions)) {
    $flightQuery .= " WHERE " . implode(" AND ", $conditions);
}



// Sort
if (isset($_GET['sort']) && $_GET['sort'] !== '') {
    $sortColumn = $_GET['sort'];
    $orderBy = " ORDER BY $sortColumn";
}

$flightQuery .= $orderBy;
$flightResult = executeQuery($flightQuery);
$airlines = executeQuery("SELECT DISTINCT airlineName FROM flightlogs ORDER BY airlineName");
$aircrafts = executeQuery("SELECT DISTINCT aircraftType FROM flightlogs ORDER BY aircraftType");
$departures = executeQuery("SELECT DISTINCT departureAirportCode FROM flightlogs ORDER BY departureAirportCode");
$arrivals = executeQuery("SELECT DISTINCT arrivalAirportCode FROM flightlogs ORDER BY arrivalAirportCode");
$creditcards = executeQuery("SELECT DISTINCT creditCardType FROM flightlogs ORDER BY creditCardType");

?>