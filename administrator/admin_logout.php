<?php
    session_start();
    unset($_SESSION['username']);
    session_destroy();
?>
<script language script="Javascript">
    alert("Anda Telah Logout");
    document.location="halaman-login-admin.php";
</script>