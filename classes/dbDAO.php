<?php
class dbDAO { 

    protected $db_connection = null;
    
    public function __construct()
    {
        // create/read session
        session_start();
    }

    public function dbConnection()
    {
        // if connection already exists
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                $this->db_connection = new PDO(DB_TYPE . ':host='. DB_HOST .';dbname='. DB_APP_NAME, DB_APP_USER, DB_APP_PASS);
                $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Disable emulated prepares (the MySQL driver has a bug/feature that will make it quote numeric arguments).
                $this->db_connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR . $e->getMessage();
                echo $e->getMessage();
            }
        }
        // default return
        return false;
    }

    public function dbDisconnect()
    {
      if($this->db_connection != NULL)
      {
        $this->db_connection = NULL;
        return true;
      }
    }
} 
?> 