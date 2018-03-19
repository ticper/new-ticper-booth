<?php
	session_start();
	session_destroy();
	print('<script>alert("ログアウトしました。); location.href = "index.php";</script>');
?>