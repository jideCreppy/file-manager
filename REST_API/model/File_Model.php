<?php


class File_Model
{

    private $connection;
    private $table_name;

    public $id;
    public $name;
    public $extension;
    public $mime_type;
    public $size;
    public $md5;
    public $dimensions;
    public $created_at;

    public function __construct($obj_connection)
    {

        $this->table_name = "uploads";
        $this->connection = $obj_connection;

    }

    /**
     * Fetch all records from the database
     * @return mixed PDO query object
     */
    public function all()
    {

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;

    }

    /**
     * Find a single record
     * @return bool
     */
    public function show()
    {

        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $result = $stmt->rowCount();

        if ($result) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($result);

            $this->id = $id;
            $this->name = $name;
            $this->extension = $extension;
            $this->mime_type = $mime_type;
            $this->size = $size;
            $this->md5 = $md5;
            $this->dimensions = $dimensions;
            $this->created_at = $created_at;

            return true;

        } else {

            return false;

        }

    }

    /**
     * Create a record
     * @return bool
     */
    public function create()
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, extension=:extension, 
                    mime_type=:mime_type, size=:size, md5=:md5, dimensions=:dimensions";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':extension', $this->extension);
        $stmt->bindParam(':mime_type', $this->mime_type);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':md5', $this->md5);
        $stmt->bindParam(':dimensions', $this->dimensions);

        if ($stmt->execute()) {

            return true;

        } else {

            echo "Something went wrong. Error - " . $stmt->error;
            return false;
        }

    }


    /**
     * Delete a record
     * @return bool
     */
    public function delete()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $this->id);


        if ($stmt->execute()) {

            return true;

        } else {

            echo "Something went wrong. Error - " . $stmt->error;
            return false;
        }

    }

}