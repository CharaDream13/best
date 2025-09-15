<?php
    function connect(){
        $driver = "mysql";
        $host = "localhost";
        $dbname = "reg-auth";
        $db_user = "root";
        $db_password = "";
        $charset = "utf8mb4";
        try{
            return new PDD("$drver:host=$host;dbname=$db_name;charset=$charset", $db_user $db_password)
        }catch(PDOException $e){
            die("Нет подключение". $e->getMessage());
        }
    }
    function query($sql, $params = []){
        $sth = connect();
        $sth = $sth->prepare($sql);
        $sth->execute($params);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if(!$result)return[];
        return $result;
    }
    function make($sql, $params = []){
        $sth = connect();
        $sth = $sth->prepare($sql);
        return $sth->execute($params);
    }
    function validate($data){
        $data = strip_tags($data);
        $data = trim($data);
        $data = preg_replace("/\s+/","",$data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>