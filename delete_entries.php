<?php

require_once(dirname(__FILE__) . '/assets2016/assets/KalturaClient.php');

/**
 *  The following performs bulk delete
 *
 *  Expects one array via POST. entries[]
 */

if ( !empty($_POST) )
{
    


    // Setup API session
    require_once("include.php");

    // Handle POST variables
    $entries = $_POST['entries'];

    //$entries = explode(",", $entries);

    // Process each entry
    foreach ($entries as $entry)
    {
        $entryId = $entry;
        // send the data
        try
        {
	    $result = $client->baseEntry->delete($entryId);
            var_dump($result);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
}

