<?php

// Makes the procedural MySQLi connection available to role views that are
// included from controller functions.
require_once dirname(__DIR__, 2) . '/config/config.php';
global $conn;
