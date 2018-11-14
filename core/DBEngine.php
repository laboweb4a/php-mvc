<?php
class DBEngine
{
    private $pdo;
    private $columns;
    private $table;

    public function __construct()
    {
        $dsn = 'mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8';
        try {
            $this->pdo = new PDO($dsn, DBUSER, DBPWD);
        } catch (Exception $e) {
            die("Erreur lors de la conneion à la base de données : ".$e->getMessage());
        }
        $this->table = strtolower(get_called_class());
    }

    public function getArticles()
    {
        return $this->pdo->query('SELECT * FROM article')->fetchAll();
    }

    public function setColumns()
    {
        $this->columns = array_diff_key(
                    get_object_vars($this),
                    get_class_vars(get_class())
        );
    }

    public function delete(){

        -

        $query = $this->pdo->prepare(" DELETE FROM ".$this->table." WHERE id= :id");
        $query->execute($this->columns);


    }

    public function save()
    {
        $this->setColumns();

        if ($this->id) {
            //UPDATE
            foreach ($this->columns as $key => $value) {
                $sqlSet[] = $key."=:".$key;
            }

            $query = $this->pdo->prepare(" UPDATE ".$this->table." SET ".implode(",", $sqlSet)." WHERE id=:id ");
            
            $query->execute($this->columns);
        } else {
            //INSERT
            unset($this->columns['id']);

            $query = $this->pdo->prepare("
                    INSERT INTO ".$this->table." 
                    (". implode(",", array_keys($this->columns)) .")
                    VALUES
                    (:". implode(",:", array_keys($this->columns)) .")
                ");

            $query->execute($this->columns);
        }
    }
}
