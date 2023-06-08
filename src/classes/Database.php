<?php 
class Database extends PDO{
    public function __construct(string $dsn, string $username, string $password, array $options = [])
    {
        // set default PDO options
        $default_options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
        $default_options[PDO::ATTR_EMULATE_PREPARES] = false;
        $default_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $options = array_replace($default_options, $options);
        parent::__construct($dsn, $username, $password, $options); // creates PDO object
    }

    public function runSQL(string $sql, array $arguments = null) {
        if(!$arguments) {
            return $this->query($sql);
        }
        $statement = $this->prepare($sql);
        $statement->execute($arguments);
        return $statement;
    }
}
?>