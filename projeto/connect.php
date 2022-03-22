<?php
    function connect(){
        $host="mysql873.umbler.com";
        $user="360";
        $pass="irisMAR100";
        $dtb="360";
    
    try{
        $result= new PDO("mysql:host=$host;dbname=$dtb;charset=utf8",$user,$pass);
        $result->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){

        throw new \Exception("ERROR: " . $e->getMessage());
    }
    return $result;
    }
    $servidor = "mysql873.umbler.com";
    $usuario = "360";
    $senha = "irisMAR100";
    $dbname = "360";
    //Criar a conexao
    

    /* @author Cesar Szpak - Celke - cesar@celke.com.br
     * @pagina desenvolvida usando FullCalendar e Bootstrap 4,
     * o código é aberto e o uso é free,
     * porém lembre-se de conceder os créditos ao desenvolvedor.
     */
    
    if(!isset($_SESSION) ){
        session_start();
        session_id();
    
    }  $url=trim($_SERVER['SERVER_NAME']);
    if(($url=='localhost') or ($url=='192.168.0.102')){ 
    /** O nome do banco de dados*/
    define('DB_NAME', 'base');
    
    /** Usuário do banco de dados MySQL */
    define('DB_USER', 'root');
    
    /** Senha do banco de dados MySQL */
    define('DB_PASSWORD', '');
    
    /** nome do host do MySQL */
    define('DB_HOST', 'localhost');
    
    
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DBNAME', '360');
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "360";
    //Criar a conexao
    $conect = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
    
    //////////////////////////////////////////////////////////////////////////////////
    try {
        $conexao = new PDO("mysql:host=localhost; dbname=360", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("set names utf8");
    } catch (PDOException $erro) {
        echo "Erro na conexão:" . $erro->getMessage();
    }
    class Database{
        private $hostname = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = '360';
        private $conexao;
    
        public function conectar(){
            $this->conexao = null;
            try
            {
                $this->conexao = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database . ';charset=utf8', 
                $this->username, $this->password);
            }
            catch(Exception $e)
            {
                die('Erro : '.$e->getMessage());
            }
    
            return $this->conexao;
        }
    } } else{
    
    
    /** O nome do banco de dados*/
    define('DB_NAME', '360');
    
    /** Usuário do banco de dados MySQL */
    define('DB_USER', '360');
    
    /** Senha do banco de dados MySQL */
    define('DB_PASSWORD', 'irisMAR100');
    
    /** nome do host do MySQL */
    define('DB_HOST', 'mysql873.umbler.com');
    
    
    define('HOST', 'mysql873.umbler.com');
    define('USER', '360');
    define('PASS', 'irisMAR100');
    define('DBNAME', '360');
    $servidor = "mysql873.umbler.com";
    $usuario = "360";
    $senha = "irisMAR100";
    $dbname = "360";
    //Criar a conexao
    $conect = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
    
    //////////////////////////////////////////////////////////////////////////////////
    try {
        $conexao = new PDO("mysql:host=mysql873.umbler.com; dbname=360", "360", "irisMAR100");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("set names utf8");
    } catch (PDOException $erro) {
        echo "Erro na conexão:" . $erro->getMessage();
    }
    class Database{
        private $hostname = 'mysql873.umbler.com';
        private $username = '360';
        private $password = 'irisMAR100';
        private $database = '360';
        private $conexao;
    
        public function conectar(){
            $this->conexao = null;
            try
            {
                $this->conexao = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database . ';charset=utf8', 
                $this->username, $this->password);
            }
            catch(Exception $e)
            {
                die('Erro : '.$e->getMessage());
            }
    
            return $this->conexao;
        }
    }
    
    
    }
    