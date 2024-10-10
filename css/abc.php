<?php
// Ensure the config files or parameters are defined
if ($params === false || empty($params)) {
    throw new \Exception('Error reading school database configuration file');
}

if ($params_truedtech === false || empty($params_truedtech)) {
    throw new \Exception('Error reading TruedTech database configuration file');
}

/******** Start TruedTech DB Credentials ********/
define('TRUEDTECH_DB_HOST', $params_truedtech['host'] ?? '');
define('TRUEDTECH_DB_USER', $params_truedtech['user'] ?? '');
define('TRUEDTECH_DB_PASS', $params_truedtech['password'] ?? '');
define('TRUEDTECH_DB_NAME', $params_truedtech['database'] ?? '');

$treudtech_conStr = sprintf(
    'mysql:host=%s;dbname=%s',
    TRUEDTECH_DB_HOST,
    TRUEDTECH_DB_NAME
);

/******** End TruedTech DB Credentials ********/

/******** Start School DB Credentials ********/
define('DB_HOST', $params['host'] ?? '');
define('DB_USER', $params['user'] ?? '');
define('DB_PASS', $params['password'] ?? '');
define('DB_NAME', $params['database'] ?? '');

$conStr = sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME);

/******** End School DB Credentials ********/

// Establish a new connection using PDO
try {
    $db_conn = new PDO($conStr, DB_USER, DB_PASS, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
    ]);

    $truedtech_db_conn = new PDO(
        $treudtech_conStr,
        TRUEDTECH_DB_USER,
        TRUEDTECH_DB_PASS,
        [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
    );
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}


?>