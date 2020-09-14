<?php


include("../public/prepare.php");

if (file_exists($LOCAL_JS_BEGIN)){
    include("$LOCAL_JS_BEGIN");
}


if (file_exists("$SYS_CONTENT_DIR/$LOCAL_CSS")){
    include("$SYS_CONTENT_DIR/$LOCAL_CSS");
}


if (file_exists($LOCAL_HEADER)){
    include($LOCAL_HEADER);
}

# Header end

# ------------------------------------------

if (!isset($L_PRIVACY)){
        if (file_exists($SYS_CONTENT_DIR."config/lang.$LANGUAGE_TITLE")){
		include($SYS_CONTENT_DIR."config/lang.$LANGUAGE_TITLE");
	}
	if (!isset($L_PRIVACY)){
		$L_PRIVACY[0]="Adatvédelmi szabályzat";
	}
}






echo("<div class=spaceline50></div>");
echo("<div class=borderbox>");
echo("<p style=\"font-weight:bold;\">$L_PRIVACY[0]</p>");
if (file_exists("$LOCAL_PRIVACY_TEXT")){
	include("$LOCAL_PRIVACY_TEXT");
}
echo("</div>");
echo("<div class=spaceline50></div>");


# ------------------------------------------

# Footer start



if (file_exists($LOCAL_FOOTER)){
    include("$LOCAL_FOOTER");
}


if (file_exists($LOCAL_JS_END)){
    include("$LOCAL_JS_END");
}


include("../public/prepare_end.php");

?>
