<?php
	// Include Database Class in the file.
	require("include/Db.class.php");

	// Creates Database instance.
	$db = new Db();
	//Run Query to select all item from menu table.
	$menu = $db->query("SELECT * FROM menu");
	
	// Function to Display Menu Properly.
	function displayMenu($tree, $parent){
        $tree2 = array();
        foreach($tree as $i => $item){
        	
            if($item['parent_id'] == $parent){
            	echo "<li>";
                $tree2[$item['id']] = $item;
                echo $item['name'];
                	// Call displaySubMenu() if it is submenu.
                	$tree2[$item['id']]['submenu'] = displaySubMenu($tree, $item['id']);
                echo "</li>";
            }
            
        }

	}


	// Submenu Function
	function displaySubMenu($tree, $parent){
        $tree2 = array();
        echo "<ul>";
        foreach($tree as $i => $item){
        	
            if($item['parent_id'] == $parent){
            	echo "<li>";
                $tree2[$item['id']] = $item;
                echo $item['name'];
                	$tree2[$item['id']]['submenu'] = displaySubMenu($tree, $item['id']);
                echo "</li>";
            }
            
        }
        echo "</ul>";
	}

	//Define parent Menu ID.
    $parent = "0";
    // passing database data through displayMenu() function. And display list of menu
    echo "<ul>";
		displayMenu($menu, $parent);
	echo "</ul>";

	// Close Database Instance.
	$db->CloseConnection();

?>
