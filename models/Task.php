<?php

class Task
{
    private $conn;
    private $table = 'task';
    public $id;
    public $title;
    public $description;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT id, title, description FROM '.$this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function rowCount()
    {
        $stmt = $this->read(); // Call the read() method
        return $stmt->rowCount(); // Get the number of rows
    }
    public function create()
    {
        $query = 'INSERT INTO '.$this->table.' (title, description) VALUES (:title, :description)';
        $stmt = $this->conn->prepare($query);
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        if($stmt->execute())
            return $stmt;
        return false;
    }
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' 
                  SET title = :title, description = :description 
                  WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
    public function delete()
    {
        $query = 'DELETE FROM '.$this->table.' WHERE id =:id ';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt;
    }
}