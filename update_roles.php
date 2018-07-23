<?php 

require_once(dirname(__FILE__) . '/assets2016/assets/KalturaClient.php');

/**
 *  The following update script will overwrite the existing user list
 *  
 *  Expects three arrays via POST. roles[], users[] and entries[]
*/

if ( !empty($_POST) ) {

    // Setup API session
    require_once("include.php");

    // Handle POST variables
    $roles = $_POST['roles'];
    $users = $_POST['users'];
    $entries = $_POST['entries'];

    $user_list = implode(",", $users);

    // Process each entry
    foreach ($entries as $entry) {
        $entryId = $entry;
        $mediaEntry = new KalturaMediaEntry();
        // add userids to selected roles
        if (in_array("0", $roles)) {
            // first user in the list becomes Owner since only one owner is allowed
            $mediaEntry->userId = $users[0];
        }
        if (in_array("1", $roles)) {
            // assign Co-Editors
            $mediaEntry->entitledUsersEdit = $user_list;
        }
        if (in_array("2", $roles)) {
            // assign Co-Publishers
            $mediaEntry->entitledUsersPublish = $user_list;
        }
        // send the data
        try {
            $result = $client->media->update($entryId, $mediaEntry);
            var_dump($result);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
