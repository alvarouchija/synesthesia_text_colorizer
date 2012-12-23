<!DOCTYPE html>
<html>
<head>
<title>Synesthesia Reading</title>
<meta name="robots" content="noindex,nofollow">
<meta charset="utf-8">
<link href="style.css" rel="StyleSheet" type="text/css">
</head>
<body>
<div class="wrapping_div">
<?php

  /*The variable $OUTPUT_SWITCH determines a way of wrap of each letter.
  0 - each letter will be wrapped by using tag <span>. The "class" attribute is used to style each letter.
      F.e. <span class=al>a</span>.
  1 - each letter will be wrapped by using tag <span>. The "id" attribute is used to style each letter, instead of attribute "class".
      F.e. <span id=al>a</span>.
  2 - each letter will be wrapped by using tag <a>.
      F.e. <a id=al>a</a>
  */
  $OUTPUT_SWITCH = 0;
  /*The variable $TEXT_FILE_NAME contains name of text file. Also it can contain URL of text file.
    F.e.
      $TEXT_FILE_NAME = "check.txt";
    or
      $TEXT_FILE_NAME = "http://somedomain/check.txt";
  */
  $TEXT_FILE_NAME = "source_text.txt";



  $handle = @fopen($TEXT_FILE_NAME, "r");
  if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
       for ($i=0;$i<=strlen($buffer);$i++) {
          $letter = substr($buffer,$i,1);

	  //if (($letter == " ") || ($letter == "\n") || ($letter == "\r\n") || ($letter == "\r")) {
	  if ($letter == " ") {
	    echo "&nbsp;";
	  } else if ($letter == "\n") {
      echo "<br>\n";
    } else if (($letter != "\n") && ($letter != "\r\n")) {
	    if (preg_match("/[A-Za-z0-9]/",$letter) > 0) {
	      switch($OUTPUT_SWITCH) {
	        case 0: echo "<span class=".(is_numeric($letter) ? "n".$letter : $letter.(preg_match("/[A-Z]/",$letter) == 0 ? "l" : "u")).">".$letter."</span>";
		   break;
		case 1: echo "<span id=".(is_numeric($letter) ? "n".$letter : $letter.(preg_match("/[A-Z]/",$letter) == 0 ? "l" : "u")).">".$letter."</span>";
		   break;
		case 2: echo "<a id=".(is_numeric($letter) ? "n".$letter : $letter.(preg_match("/[A-Z]/",$letter) == 0 ? "l" : "u")).">".$letter."</a>";
		   break;
	      }
	    } else {
	      echo $letter;
	    }
	  }

	  unset($letter);
       }
    }

    if (!feof($handle)) {
      echo "Error: unexpected fgets() fail\n";
    }

    fclose($handle);
  }

?>
</div>
</body>
</html>