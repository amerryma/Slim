<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 12/24/13
 * Time: 2:19 PM
 */

/**
 * This class contains all functions related to queries and returning results based on those queries.
 */
class SQL
{
    private $sqlcon;

    public function __construct()
    {
        $this->sqlcon = mysql_connect("database_url", "database_username", "database_password")or die("cannot connect");
        $error = mysql_select_db("database_dbname") == true;
    }

    /**
     * Returns the results from a select query.
     * @param  string $query
     * @return $bigarray associative array with each row selected, the column name and the value.
     */
    public function getSelectQuery($query)
    {
        $result=mysql_query($query);
        $bigarray = array();
        if ($result) {
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $bigarray[] = $row;
            }
        }
        return $bigarray;
    }

    /**
     * Returns the last insert ID.
     * @param  string $query
     * @return $id
     */
    public function getInsertQuery($query) {
        $result=mysql_query($query);
        $id = mysql_insert_id();
        return $id;
    }

    public function __destruct()
    {
        mysql_close($this->sqlcon);
    }
}