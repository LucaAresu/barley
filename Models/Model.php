<?php


class Model
{
    protected $tableName;
    private $conn;

    public function __construct(array $attr = [])
    {
        if(!$this->tableName)
            $this->tableName = 'bg_'.strtolower(get_class($this)).'s';
        $this->conn = DB::create()->getConn();
        foreach($attr as $key => $val)
            $this->$key = $val;
    }

    public function create(array $attr = [])
    {
        $this->__construct($attr);
        $sql = "insert into $this->tableName (".    $this->querySegnapostoHelper($attr,'',', ')     .') ';
        $sql.= "values (".  $this->querySegnapostoHelper($attr,':',', ')    .')';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($attr);

        $this->id = $this->conn->lastInsertId();

    }
    public function update(array $attr) {
        if(!$this->id)
            throw new Exception('Update non supporta gli oggetti senza id');
        $sql = "update $this->tableName set ";
        foreach($attr as $key => $val)
            $sql.= "$key=:$key, ";
        $sql = substr($sql,0,strlen($sql)-2);
        $sql.= " where id=:id";
        $stmt = $this->conn->prepare($sql);
        $attr['id'] = $this->id;
        $stmt->execute($attr);
        foreach($attr as $key => $val)
            $this->$key = $val;
    }

    public static function find(int $id)
    {
        $obj = new static();
        $stmt = $obj->conn->prepare("select * from $obj->tableName where id=:id");
        $stmt->execute(['id' => $id]);
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount()) {
            foreach ($arr as $key => $val)
                $obj->$key = $val;
            return $obj;
        }
        return null;
    }

    public static function whereEqual($column, $val)
    {
        $obj = new static();
        $stmt = $obj->conn->prepare("select * from $obj->tableName where $column=:val");
        $stmt->execute(['val' => $val]);
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount()) {
            foreach ($arr as $key => $val)
                $obj->$key = $val;
            return $obj;
        }
        return null;
    }

    private function querySegnapostoHelper($attr, $pre =  '', $post = '')
    {
        $str = '';
        foreach($attr as $key => $value)
            $str.= $pre.$key.$post;
        $str = substr($str,0,strlen($str)-strlen($post));
        return $str;
    }

}