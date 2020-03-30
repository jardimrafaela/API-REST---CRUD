# API REST - CRUD

#### Configurações:
- PHP 5.6
- DataBase MySQL 5.7
- Server Apache

#### Funções:

- Ler tabelas do DB (read)
- Criar novo registro no DB (create)
- Atualizar registro existente (update)
- Excluir Registro (delete)

#### Requisitos para teste:

- Software de teste API (www.postman.com)
- Suporte para criação de DB MySQL

#### Requisitos para desenvolvimeno:

- Ambiente próprio para programação em PHP e Json
- PHP 5.6
- Suporte para criação de DB MySQL

#### Request url GET /todos/

    http://www.api.rafaelajardim.kinghost.net/todos

#### Response:

    Access-Control-Allow-Origin	*
    Connection	Keep-Alive
    Content-Encoding	gzip
    Content-Type	application/json; charset=UTF-8
    Date	Mon, 30 Mar 2020 18:12:09 GMT
    Keep-Alive	timeout=5, max=500
    Server	Apache
    Transfer-Encoding	chunked
    Vary	Accept-Encoding

## "read"Request POSTMAN url (GET)

        http://www.api.rafaelajardim.kinghost.net/todos

    Response:

        {
        "Display produtos": [
            {
                "id": "7",
                "description": "Porche Cayenne",
                "completed": "Sim",
                "createdAt": "2020-03-30",
                "updatedAt": "2020-03-30"
            },
            {....
            ...}]}


#### Request url POST /todos/

    http://www.api.rafaelajardim.kinghost.net/todos

#### Response:

    Access-Control-Allow-Method	POST
    Access-Control-Allow-Origin	*
    Access-Control-Max-Age	3600
    Connection	Keep-Alive
    Content-Encoding	gzip
    Content-Type	application/json; charset=UTF-8
    Date	Mon, 30 Mar 2020 18:22:07 GMT
    Keep-Alive	timeout=5, max=500
    Server	Apache
    Transfer-Encoding	chunked
    Vary	Accept-Encoding    

## "create" Request POSTMAN url (POST)

        http://www.api.rafaelajardim.kinghost.net/todos

  #### Parameters:
  
*"completed"*
*1 = SIM
0 = NÃO 
null = NÃO*


        {
        "description" : "Balões",
        "completed" : ""
        }

  #### Response http 200:
        
        {"message": "Produto criado com sucesso"}

#### Response http 400:
	{"message": "Não foi possível criar o produto, verifique se os dados estão completos."}
		

