<?php
/**
 * PHP Deepelopment Framework.
 *
 * @package Deepelopment/Compatibility/PHP7
 * @license Unlicense http://unlicense.org/
 */

namespace Deepelopment\Compatibility\PHP7;

use RuntimeException;
use Deepelopment\Core\EntityProvider;

define('MYSQL_ASSOC', MYSQLI_ASSOC);
define('MYSQL_BOTH', MYSQLI_BOTH);
define('MYSQL_NUM', MYSQLI_NUM);

/**
 * Class and funstions providing partial PHP7 MySQL support.
 *
 * @author deepeloper ({@see https://github.com/deepeloper})
 */
class MySQLProvider extends EntityProvider
{
    protected static $instance;

    public static function init()
    {
        self::$instance = new self;
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public static function defaultLink($link)
    {
        if (is_null($link)) {
            $link = self::$instance->getDefault();
        }
        /*
        echo "---\nDefault link: ";
        ob_start();
        var_dump($link);
        $output = ob_get_clean();
        $output = substr($output, 0, strpos($output, '{'));
        echo "{$output}\n";###
        // $e = new Exception; echo $e->getTraceAsString(), "\n\n";###
        */
    }

    public static function close($link)
    {
        $id = self::$instance->find($link);
        self::$instance->free($id);
        unset($link);
    }

    public static function connect($link)
    {
        static $idCount = 0;

        // echo "CONNECT CALLED:\n"; $e = new Exception; echo $e->getTraceAsString(), "\n\n";###
        try {
            $id = self::$instance->find($link, ++$idCount);
            self::$instance->setDefaultId($id);
        } catch (RuntimeException $e) {
            $id = (string)$idCount;
            self::$instance->add($id, $link);
        }
    }
}

MySQLProvider::init();

function mysql_affected_rows($link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_affected_rows($link);

    return $return;
}

function mysql_client_encoding($link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_client_encoding($link);

    return $return;
}

function mysql_close($link = NULL)
{
    MySQLProvider::defaultLink($link);
    MySQLProvider::close($link);
    $return = mysqli_close($link);

    return $return;
}

function mysql_connect(
    $server = NULL,
    $username = NULL,
    $password = NULL,
    $new_link = FALSE,
    $client_flags = 0
)
{
    if (is_null($server)) {
        $server = ini_get('mysql.default_host');
    }
    if (is_null($username)) {
        $username = ini_get('mysql.default_user');
    }
    if (is_null($password)) {
        $password = ini_get('mysql.default_password');
    }
    $link = mysqli_connect($server, $username, $password);
    // file_put_contents('d:/q.txt', "sss\n", FILE_APPEND);###
    MySQLProvider::connect($link);

    return $link;
}

/*
function mysql_create_db($link = NULL) {
    MySQLProvider::defaultLink($link);

    return mysqli_create_db($link);
}
*/

function mysql_data_seek($result, $row_number)
{
    $return = mysqli_data_seek($result, $row_number);

    return $return;
}

/*
function mysql_db_name($result, $row, $field = NULL)
{
    MySQLProvider::defaultLink($link);

    return mysqli_db_name($result, $row, $field = NULL);
}

mysqli_db_query();
mysql_drop_db

*/

function mysql_errno($link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_errno($link);

    return $return;
}

function mysql_error($link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_error($link);

    return $return;
}

function mysql_escape_string($unescaped_string)
{
    $link = NULL;
    MySQLProvider::defaultLink($link);
    $return = mysqli_escape_string($link, $unescaped_string);

    return $return;
}

function mysql_fetch_array($result, $result_type = MYSQLI_BOTH)
{
    $return = mysqli_fetch_array($result, $result_type);
    /*
    ob_start();
    var_dump($result);
    $output = ob_get_clean();
    $output = substr($output, 0, strpos($output, '{'));
    echo "---\nmysqli_fetch_array({$output}) result:\n"; var_dump($return); echo "\n";###
    if(preg_match('/\#(?:4|15) /', $output)){
        $e = new Exception; echo $e->getTraceAsString(), "\n\n";###
    }
    */

    return $return;
}

function mysql_fetch_assoc($result)
{
    $return = mysqli_fetch_assoc($result);
    /*
    ob_start();
    var_dump($result);
    $output = ob_get_clean();
    $output = substr($output, 0, strpos($output, '{'));
    echo "---\nmysqli_fetch_assoc({$output}) result:\n"; var_dump($return); echo "\n";###
    */

    return $return;
}

function mysql_fetch_field($result, $field_offset = 0)
{
    $return = mysqli_fetch_field($result, $field_offset);

    return $return;
}

function mysql_fetch_lengths($result)
{
    $return = mysqli_fetch_lengths($result);

    return $return;
}

function mysql_fetch_object($result, $class_name = NULL, array $params = NULL)
{
    $return = mysqli_fetch_object($result, $class_name, $params);

    return $return;
}

function mysql_fetch_row($result)
{
    $return = mysqli_fetch_row($result);

    return $return;
}

/*
mysql_field_flags( resource $result , int $field_offset )
mysql_field_len ( resource $result , int $field_offset )
string mysql_field_name ( resource $result , int $field_offset )
*/

function mysql_field_seek($result, $field_offset = 0)
{
    $return = mysqli_field_seek($result, $field_offset);

    return $return;
}

/*
mysql_field_table ( resource $result , int $field_offset )
mysql_field_type ( resource $result , int $field_offset )
*/

function mysql_free_result($result)
{
    $return = mysqli_free_result($result);

    return $return;
}

function mysql_get_client_info($result)
{
    $return = mysqli_get_client_info($result);

    return $return;
}

function mysql_get_host_info($link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_get_host_info($link);

    return $return;
}

function mysql_get_proto_info($link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_get_proto_info($link);

    return $return;
}

function mysql_get_server_info($link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_get_server_info($link);

    return $return;
}

function mysql_num_rows($result)
{
    $return = mysqli_num_rows($result);

    return $return;
}

// ....

function mysql_query($query, $link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_query($link, $query);
    /*
    echo "\n---\nQUERY: {$query}\n", "mysqli_query() result: "; var_dump($return); echo "\n";###
    $e = new Exception; echo $e->getTraceAsString(), "\n\n";###
    */

    return $return;
}

// ....

function mysql_real_escape_string($string, $link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_real_escape_string($link, $string);

    return $return;
}

// ....

function mysql_select_db($database_name, $link = NULL)
{
    MySQLProvider::defaultLink($link);
    $return = mysqli_select_db($link, $database_name);

    return $return;
}

// ....

