<?php

// Inclut le fichier de connexion à la base
//require_once est utilisé pour inclure le fichier spécifié, ici Database.php, situé dans le dossier ../src/Config/ (un niveau au-dessus, puis dans src/Config/).
//require_once est utilisé pour s'assurer que le fichier n'est inclus qu'une seule fois, même s'il est référencé plusieurs fois. Cela est important pour éviter des erreurs de redéclaration de classes ou de fonctions.
require_once '../src/Config/Database.php';

// Indique que la réponse sera en JSON
//Cette ligne indique au client (navigateur ou logiciel consommant l'API) que la réponse sera envoyée au format JSON.
//Le header Content-Type: application/json est utilisé pour spécifier le type de contenu de la réponse. Cela permet aux consommateurs de l'API de savoir qu'ils doivent traiter la réponse comme un objet JSON.
header('Content-Type: application/json');



// Ce bloc est utilisé pour gérer les exceptions et vérifier que l'API est fonctionnelle.

// try { ... } :

// Le code placé dans le bloc try est celui qui est testé. Ici, il s'agit d'un test simple qui renvoie une réponse JSON pour vérifier que l'API est en cours d'exécution.
// echo json_encode(['status' => 'API is running']); : Cette ligne renvoie un objet JSON avec une clé 'status' et la valeur 'API is running'. Cela permet de confirmer que l'API fonctionne bien.
// catch (Exception $e) { ... } :

// Le bloc catch est exécuté si une exception est levée dans le bloc try.
// http_response_code(500); : Cette ligne envoie un code de réponse HTTP 500 au client, indiquant qu'il y a eu une erreur interne du serveur.
// echo json_encode(['error' => $e->getMessage()]); : Cela renvoie un objet JSON contenant un message d'erreur détaillant la cause du problème. $e->getMessage() permet d'obtenir le message d'erreur associé à l'exception levée.

try {
    // Test simple pour vérifier que l'API fonctionne
    echo json_encode(['status' => 'API is running']);
} catch (Exception $e) {
    // En cas d'erreur, renvoie un code 500 et le message d'erreur
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

// Utilité de ce fichier index.php
// Point d'entrée de l'API : Ce fichier agit comme le point d'entrée principal pour toutes les requêtes vers ton API. Lorsqu'une requête est faite à ton API, c'est ce fichier qui est exécuté en premier.
// Initialisation et test :
// Il vérifie si l'API est fonctionnelle en renvoyant un message de confirmation ('API is running').
// Le try...catch permet de capturer toute erreur potentielle dès le début, assurant ainsi une gestion propre des erreurs, et renvoie une réponse appropriée au client.
// Format JSON : L'utilisation de JSON permet de standardiser les réponses de l'API de manière à ce qu'elles soient facilement compréhensibles et utilisables par les clients (navigateur, mobile, autre serveur).
// Comment le fichier est utilisé dans ton application
// Lorsque tu accèdes à ton API via le navigateur ou un outil comme Postman (par exemple, avec l'URL http://localhost/todo-api/public/), le fichier index.php est exécuté.
// Il renvoie simplement une réponse JSON indiquant que l'API fonctionne ({'status': 'API is running'}).
// // Ce fichier servira également à router les requêtes entrantes, éventuellement en créant un système de routes qui redirigera les demandes spécifiques (comme /tasks ou /lists) vers les méthodes appropriées pour traiter ces actions.
