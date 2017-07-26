<?php
// Routes

/*$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://desenv.duckdns.org')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/users', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM users ORDER BY id");
        $sth->execute();
        $usersList = $sth->fetchAll();
        return $this->response
                    ->withHeader('Access-Control-Allow-Origin', 'http://desenv.duckdns.org')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                    ->withJson($usersList);

    });

$app->get('/users/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM users WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $userFound = $sth->fetchObject();
        return $this->response->withJson($userFound);
    });

$app->get('/users/search/[{query}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM users WHERE UPPER(name) LIKE :query ORDER BY name");
        $query = "%".$args['query']."%";
        $sth->bindParam("query", $query);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', 'http://desenv.duckdns.org')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withJson($todos);
    });

$app->post('/users', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO users (name,value) VALUES (:name,:value)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("name", $input['name']);
        $sth->bindParam("value", $input['value']);
        $sth->execute();
        $input['id'] = $this->db->lastInsertId();
        return $this->response->withJson($input);
    });

$app->put('/users/[{id}]', function ($request,$response, $args) {
       $input = $request->getParsedBody();
        $sql = "UPDATE users SET name=:name,value=:value WHERE id=:id";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("name", $input['name']);
        $sth->bindParam("value", $input['value']);
        $sth->execute();
        $input['id'] = $args['id'];
        return $this->response->withJson($input);
        
    });

$app->delete('/users/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("DELETE FROM users WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $users = $sth->fetchAll();
        return $this->response->withJson($users);
    });

/*$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/