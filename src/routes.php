<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/{standard}/{searchterm}/search', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $pdo = $this->get("pdo");
    $searchTerm = '%'.$args['searchterm'].'%';
    /**
     * @var $pdo \PDO
     */
    //TODO lookup standard. //Complain if standard not found
    $pdostatement = $pdo->prepare("SELECT * FROM standardversion WHERE label LIKE :term");
    $pdostatement->bindParam('term', $searchTerm);
    $pdostatement->execute();


    $pdostatement = $pdo->prepare("SELECT * FROM standardelements WHERE label LIKE :term");
    $pdostatement->bindParam('term', $searchTerm);
    $pdostatement->execute();

    $jsons = [];
    foreach($pdostatement->fetchAll() as $element)
    {
        $jsons[] = '{
            "code" : "'.$element["code"].'",
            "label" : "'.$element["label"].'"
        }';

    }
    $body = $response->getBody();
    $body->write("[". implode(",", $jsons) . "]");
    $newResponse = $response->withHeader('Content-type', 'application/json');
    // Render index view
    return $newResponse;
});

$app->get('/{standard}/{name}/details', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
