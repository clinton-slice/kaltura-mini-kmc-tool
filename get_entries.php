<?php

require_once(dirname(__FILE__) . '/assets/KalturaClient.php');
// Include settings
require_once("include.php");

$filter = new KalturaMediaEntryFilter();
$filter->freeText = $_GET["query"]; // freeText searches all fields
$filter->orderBy = "-createdAt";
$pager = new KalturaFilterPager();
$pager->pageSize = 300;
//$pager->pageIndex = 1;

try {
    $filteredListResult = $client->media->listAction($filter, $pager);
    $result_count = $filteredListResult->totalCount;
    // create a table for all the entries
    $table = array();
    foreach ($filteredListResult->objects as $entry) {
        // process each entry
        $row = array();
        $row[] = $entry->id;
        $row[] = $entry->thumbnailUrl;
        $row[] = $entry->name;
        $row[] = date('Y-m-d H:i', $entry->createdAt);
        $row[] = $entry->creatorId;
        $row[] = $entry->userId;
        $row[] = $entry->entitledUsersEdit;
        $row[] = $entry->entitledUsersPublish;
        // add the entry to the table
        $table[] = $row;
    }
    echo json_encode($table);
}
catch(Exception $ex) {
    echo "could not get entry from Kaltura. Reason: " . $ex->getMessage();
}