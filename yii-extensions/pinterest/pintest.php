<?php
require_once "Pinterest.class.php";


// Create the pinterest object and log in
$p = new Pinterest();
$p->login("mypinterestlogin", "mypinterestpassword");

// Set up the pin
$p->pin_url = "http://yellow5.com";
$p->pin_description = "My awesome pin";
$p->pin_image_preview = $p->generate_image_preview("compot.jpg");

// Get the boards
$p->get_boards();

// Pin to the board called "Items"
$p->pin($p->boards['Items']);

// And we're done
echo "Hooray!\n";
