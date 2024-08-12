<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

try {
    $id = $_GET['id'];
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = "SELECT * FROM customers WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('id', $id, PDO::PARAM_INT);
    $stmt->execute(['id' => $id]);
    print_r($stmt->fetch(PDO::FETCH_ASSOC));
    // $sql = 'select * FROM orders';
    // foreach ($conn->query($sql) as $row) {
    //     echo $row['id'];
    // }
    // print_r('$conn->query($sql)');
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection Failed:" . $e->getMessage() . "";
}

function find($table, $id, $columns = [])
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $id = $_GET['id'];
    $column = '*';
    if (count($columns) > 0) {
        $column = implode(', ', $columns);
    }
    $stmt = $conn->prepare("SELECT $column FROM $table WHERE id = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$data = find('currencies', 10, ['id', 'name']);

print_r($data);

//--------------------------------------------------------------------------------
function all($table, $limit = null, $offset = null, $columns = [])
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $id = $_GET['id'];
    $column = '*';
    if (count($columns) > 0) {
        $column = implode(', ', $columns);
    }
    $sql = "SELECT $column FROM $table  ";
    if (!is_null($limit)) {
        $sql .= "LIMIT $limit ";
    }
    if (!is_null($offset)) {
        $offset = $offset * $limit;
        $sql .= "OFFSET $offset ";
    }
    // print_r($sql);
    $stmt = $conn->prepare("SELECT $column FROM $table");
    $stmt->execute();
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
}

$page = @$_GET['page'] ?? 0;
$data = all('currencies', 10, $page);

print_r($data);

//----------------------------------------------------------------------------
function insert($table, $data)
{
    try {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydatabase";
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $sql = "INSERT $table SET";
        $subSQL = [];
        foreach ($data as $column => $value) {
            $subSQL[] = "$column=:$column";
        }
        $sql .= implode(', ', $subSQL);
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
        return true;
    } catch (PDOException $e) {
        echo "Connection Failed:" . $e->getMessage() . "";
    }
}

$page = @$_GET['page'] ?? 0;
$data = insert(
    'currencies',
    [
        'country' => 'Qatar',
        'code' => 'QAT',
        'numeric_code' => 10
    ]
);

var_dump($data);

//------------------------------------------------------------
$where = [
    ['id', '>', 5, 'OR'],
    ['id', '<', 10, 'OR']
];

function delete($table, $where)
{
    try {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydatabase";
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $sql = "DELETE $table FROM  ";
        $subSQL = '';
        $tokens = [];
        if (count($where) < 2 and isset($where[0][3])) {
            unset($where[0][3]);
        }
        foreach ($where as $wk => $whereQuery) {
            if (is_array($whereQuery)) {
                foreach ($whereQuery as $key => $detailQuery) {
                    if ($key != 2) {
                        $subSQL .= ' ' . $detailQuery;
                    } else {
                        $subSQL .= ' :' . $whereQuery[0] . $wk;
                        $tokens[$whereQuery[0] . $wk] = $detailQuery;
                    }
                }
            }
        }

        $sql .= $subSQL;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection Failed:" . $e->getMessage() . "";
    }
}

// delete('currencies', $where);

//-------------------------------------
