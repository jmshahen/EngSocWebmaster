<?php

require "generate_html.php";

if(isset($_POST['stream']) && isset($_POST['term']) && 
	isset($_POST['year']) && ($_FILES["csv"]["error"] == 0))
{
	$stream = $_POST['stream'];
	$term = $_POST['term'];
	$year = $_POST['year'];
	$results = (
		//validate stream
		($stream == 'A' || $stream == 'B') &&
		// check temporay file
		(($filep = fopen($_FILES["csv"]["tmp_name"], "r")) !== FALSE)
	);
}
else
{ $results = false; }

if($results == true):
	$gen_html = generate_html($filep, $stream, $term, $year);

	echo "<h1>Results:</h1>Below is the generated HTML for {$stream}-Soc:<br/>";
	echo "<textarea rows='8' cols='50'>" . $gen_html . "</textarea><br/><br/>";
	echo "<h2>Preview</h2>" . $gen_html;
else:
?>

<h1>Directorship HTML Generator</h1>
Hello EngSoc Webmaster,
<br/>
<span style="color: red; font-style:italic;">
	If you are not the Webmaster please report this to: 
	<a href="mailto:webmaster@engsoc.uwaterloo.ca">
		webmaster@engsoc.uwaterloo.ca
	</a>
</span>

<br/>
<br/>

The form below will generate the proper

<form method="post" style="border: 1px solid;" enctype="multipart/form-data">
	<b>Society:</b>
	<br/>
	<label><input type="radio" name="stream" value="A" checked="true"/>A-Soc</label>
	<br/>
	<label><input type="radio" name="stream" value="B"/>B-Soc</label>

	<br/>
	<br/>

	<b>Term:</b>
	<br/>
	<select name="term">
		<option value="Fall">Fall</option>
		<option value="Winter">Winter</option>
		<option value="Spring">Spring</option>
	</select>

	<br/>
	<br/>

	<b>Year:</b>
	<br/>
	<select name="year">
		<?php
			$y = date("Y") - 1;
			echo "\t\t<option value=\"$y\">$y</option>";
			$y += 1;
			echo "\t\t<option value=\"$y\">$y</option>";
			$y += 1;
			echo "\t\t<option value=\"$y\">$y</option>";
		?>
	</select>

	<br/>
	<br/>


	<b>CSV File:</b> &nbsp;
	<span style="font-style:italic;">NOTE: See below for correct format</span>
	<br/>
	<input type="file" name="csv" />

	<br/>
	<br/>
	
	<input type="submit" value="Generate" />
</form>
<?php
endif;
?>