<?php

require_once(dirname(__FILE__) . '/assets/KalturaClient.php');
// include settings
require_once("include.php");

// Set the filter params
$filter = new KalturaUserFilter();
$filter->statusEqual = KalturaUserStatus::ACTIVE;
$filter->isAdminEqual = KalturaNullableBoolean::FALSE_VALUE;
$filter->idOrScreenNameStartsWith = $_GET["query"];

// Set pagesize params (normally used for pagination)
$pager = new KalturaFilterPager();

try {
    $filteredUserListResult = $client->user->listAction($filter, $pager);
    $result_count = $filteredUserListResult->totalCount;

    // create an array for all the users
    $users = array();
    // add all the users to the dataset
    foreach ($filteredUserListResult->objects as $user) {
        // process each user
        $users[] = $user->id;
    }
    $pager->pageIndex += 1; // go to next page
    $filteredUserListResult = $client->user->listAction($filter, $pager);

    header('Content-Type: application/json');
    //echo json_encode(array("data" => $users));
    echo json_encode($users);
}
catch(Exception $ex) {
    echo "could not get entry from Kaltura. Reason: " . $ex->getMessage();
}