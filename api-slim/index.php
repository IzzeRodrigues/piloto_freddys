<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
$app = new \Slim\App;

$app -> get('/', function (Request $request, Response $response, array $args){
    $response->getBody()->write("API");
    return $response;
});

$app -> get('/pizzas','getPizzas');
$app -> post('/users','getUser');
$app -> post('/pedido','getPedido');
$app -> get('/pedidos/{id}', 'getPizza');
$app -> post('/entrar','getLogin');




function getConn(){
    return new PDO('mysql:host=localhost:3306;dbname=db_freddys', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}; 

function getPizzas(Request $request, Response $response, array $args){
    $sql = "SELECT * FROM tb_pizzas";
    $stmt = getConn()->query($sql);
    $pizza = $stmt -> fetchAll(PDO::FETCH_OBJ);
    $response->getBody()->write(json_encode($pizza));
    return $response;
};

function getPizza(Request $request, Response $response, array $args){
    $id = $args['id'];
    $conn = getConn();
    $sql = "SELECT * FROM tb_pizzas WHERE id_pizza=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('id',$id);
    $stmt->execute();

    $pizza = $stmt->fetchObject();
    $response->getBody()->write(json_encode($pizza));
    return $response;
};

function getUser(Request $request, Response $response, array $args){
    $usuario = $request->getParsedBody();
    $nome = $usuario["body"]["name"];
    $senha =  $usuario["body"]["senha"];
    $email =  $usuario["body"]["email"];
    $login =  $usuario["body"]["Login"];
    
    if ($login == "cliente"){
        $cep =  $usuario["body"]["cep"];
        $rua =  $usuario["body"]["rua"];
        $num =  $usuario["body"]["num"];
        $bairro =  $usuario["body"]["bairro"];
        $cidade =  $usuario["body"]["cidade"];
        $uf =  $usuario["body"]["uf"];

        $sql = "INSERT INTO tb_clientes(nm_usuario, nm_email_usuario, cd_senha_usuario, priv_usuario, cd_cep, nm_rua, cd_numero_endereco, nm_bairro, nm_cidade, nm_estado) VALUES('$nome', '$email', '$senha', '$login', '$cep', '$rua', '$num', '$bairro', '$cidade', '$uf')";
        $stmt = getConn()->query($sql);

    } else {
        $sql = "INSERT INTO tb_clientes(nm_usuario, nm_email_usuario, cd_senha_usuario, priv_usuario) VALUES('$nome', '$email', '$senha', '$login')";
        $stmt = getConn()->query($sql);
    };
};

function getLogin(Request $request, Response $response, array $args){
    $usuario = $request->getParsedBody();
    $nome = $usuario["body"]["name"];
    $senha =  $usuario["body"]["senha"];
    $conn = getConn();
    $sql = "SELECT * FROM tb_clientes WHERE nm_usuario = '$nome' and cd_senha_usuario = '$senha' ";
    $stmt = getConn()->prepare($sql);
    $stmt -> execute();
    $result = $stmt->fetchObject();
        if ($result->priv_usuario == 'funcionario'){
            $privilegio = 'funcionario';
            return $privilegio;
        } else {
            $privilegio = 'cliente';
            return $privilegio;
        };
};

function getPedido(Request $request, Response $response, array $args){
    $sabores = $request->getParsedBody();
    $nome = $sabores["body"]["Name"];
    $valor =  $sabores["body"]["Valor"];
    $sql = "INSERT INTO tb_pedidos(nm_pedido, vl_pedido) VALUES('$nome', '$valor')";
    $stmt = getConn()->query($sql);
};

$app->run(); 
