<?php
/*****
   This is the file that will write the posted form data as a text file on the server. 

   The format the data is in depends on how the file will be used later - human readable 
   such as a simple log or document; comma or tab delimited for loading into a spreadsheet;
   even serialized as JSON data.

   This example will take the posted data and write to a simple file and create a NEW file 
   for each form request.

 */

// generate unique file name using request timestamp
$filename = 'contact_' . $_SERVER['REQUEST_TIME'] . '.txt';

// get the current date in readable form
$today = date('r');

// Since this is just a human-readable file, I'll use a heredoc to make the formatting easier.
// ref: http://php.net/language.types.string#language.types.string.syntax.heredoc
$output = <<<EOD
New Contact received {$today} via IP {$_SERVER['REMOTE_ADDR']}

First Name: {$_POST['firstname']}
 Last Name: {$_POST['lastname']}
     Email: {$_POST['email']}
EOD;

// Now save the file
// Note that the file location must be writeable by PHP
$fp = fopen($filename,"w"); 	// open file for writing
fwrite($fp, $output); 			// write output to file
fclose($fp); 					// close file


echo '<p>Contact data has been saved to ' . $filename . '<p>';

?>