const express = require("express");
const rotaex = express();

rotaex.get("/envmsg", function(req, res){
    res.send("Enviar mensagem!");
});

rotaex.get("/cad/:cargo/:nome" , function(req, res){
    res.send("<h1> Olá "+ req.params.nome + "</h1>");
});

rotaex.listen(8002, function(){
    console.log("Servidor rodando na url http://localhost:8002");
});