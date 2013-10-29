<?php

class MySqlAdapter
{

    public $_dbHandle;

    /** Connects to database * */
    function connect()
    {
        $this->_dbHandle = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        if ($this->_dbHandle != 0) {
            if (mysql_select_db(DB_NAME, $this->_dbHandle)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    /** Disconnects from database * */
    function disconnect()
    {
        if (@mysql_close($this->_dbHandle) != 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /** Get error string * */
    function getError()
    {
        return mysql_error($this->_dbHandle);
    }

}
