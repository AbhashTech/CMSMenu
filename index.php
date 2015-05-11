<?php
	// Include Database Class in the file.
	require("include/Db.class.php");

	// Creates Database instance.
	$db = new Db();
	//Run Query to select all item from menu table.
	$menu = $db->query("SELECT * FROM menu");
	
	// Function to Display and Rearrange Menu Properly.
	function displayMenu($tree, $parent){
        $tree2 = array();
        foreach($tree as $i => $item){
            if($item['parent_id'] == $parent){
                $tree2[$item['id']] = $item;
                $tree2[$item['id']]['submenu'] = displayMenu($tree, $item['id']);
            }
        }

        return $tree2;
	}

	//Define parent Menu ID.
    $parent = "0";
    // Pass Menu data to displayMenu() function to rearrange it properly.
    $final = displayMenu($menu, $parent);
    
    // Echo var_dump() of menu data after passing through displayMenu() function, in a preformatted format. 
    echo "<pre>";
	var_dump($final);
	echo "</pre>";

	// Close Database Instance.
	$db->CloseConnection();

?>
