<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Connexion::login'); 
$routes->get('connexion', 'Connexion::login');
$routes->post('/connexion/valider', 'Connexion::valider');  
$routes->get('/connexion/deconnexion', 'Connexion::deconnexion');  

$routes->get('/accueil', 'Accueil::index');  

$routes->get('Gererfrais', 'GererFrais::index');
$routes->post('Gererfrais/maj_fraisforfait', 'GererFrais::valider_maj_fraisforfait');
$routes->post('Gererfrais/creation_fraishorsforfait', 'GererFrais::valider_creation_fraishorsforfait');
$routes->get('Gererfrais/supp_fraishorsforfait/(:num)', 'GererFrais::supprimer_fraishorsforfait/$1');

$routes->get('Etatfrais', 'EtatFrais::index');
$routes->post('Etatfrais/mois', 'EtatFrais::selectionner_mois');