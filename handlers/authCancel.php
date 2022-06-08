<?php
if(session_start()){
    session_destroy();
}
$referer = parse_url($_SERVER['HTTP_REFERER']);
header("Location: ".$referer['path']);
