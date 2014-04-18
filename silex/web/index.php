<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
	
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$app->get('/events/', function(Request $request) {

	$db = new PDO('mysql:host=localhost;dbname=apibuild;charset=utf8', 'root', 'root');
	$stmt = $db->query('SELECT * FROM books');
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return new Response(json_encode($results), 200, array(
		'Content-Type' => 'application/json'
		));
});

$app->post('/event', function (Request $request) use ($app) {
	if (!$data = $request->getContent()) {
		return new Response('Missing Parameters', 400);
	}
	$request->getContent();
	$db = new PDO('mysql:host=localhost;dbname=apibuild;charset=utf8', 'root', 'root');
	$affected_rows = $db->prepare("INSERT INTO books(id, title, author) VAULES(:id, :title, :author)");
	$affected_rows->execute(array(':id' => $id,  ':title' => $title, ':author' => $author));
	if ($title === null){
		return new Response ($data, 200);
	}

    return $app->redirect('/event/'. $event->id, 201);
});


$app->put('/event/{id}', function ($id) use ($app) {
	$db = new PDO('mysql:host=localhost;dbname=apibuild;charset=utf8', 'root', 'root');
	$affected_rows = $db->prepare("INSERT INTO books(id, title, author) VAULES(:id, :title, :author)");
	$affected_rows->execute(array(':id' => $id,  ':title' => $title, ':author' => $author));
	if ($title === null){
		return new Response ("no variables", 200);
	}
	else {
		return new Response($title, 200);
	}

});

$app->delete('/event/{id}', function ($id) use ($app) {
	$db = new PDO('mysql:host=localhost;dbname=apibuild;charset=utf8', 'root', 'root');
	$stmt = $db->prepare("DELETE FROM table WHERE id=:id");
	$stmt->bindValue(':id', $id, PDO::PARAM_STR);
	$stmt->execute();
	$affected_rows = $stmt->rowCount();

	if (!$id) {
		return new Response('Even not found.', 404);
	}


	return new Response('Event deleted.', 200);

});


$app->run();


