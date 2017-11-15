
<?php
wp_load_translations_early();

$protocol = $_SERVER["SERVER_PROTOCOL"];
if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
	$protocol = 'HTTP/1.0';
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );
header( 'Retry-After: 600' );

// большинство функций WP не работают
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"<?php if ( is_rtl() ) echo ' dir="rtl"'; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Техническое обслуживание</title>
</head>
<body>
	<div style="max-width:800px; margin:50px auto; text-align:center;">
		<h1>Сайт находится на техническом обслуживании, работа будет восстановлена через несколько минут.</h1>
		<h2>Извините за неудобства.</h2>        
	</div>
</body>
</html>