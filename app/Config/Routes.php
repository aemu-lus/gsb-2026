<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Connexion::login'); 
$routes->get('connexion', 'Connexion::login');
$routes->post('/connexion/valider', 'Connexion::valider');  
$routes->get('/connexion/deconnexion', 'Connexion::deconnexion');  

$routes->get('/Accueil', 'Accueil::index');  

$routes->get('Gererfrais', 'Gererfrais::index');
$routes->post('Gererfrais/maj_fraisforfait', 'Gererfrais::valider_maj_fraisforfait');
$routes->post('Gererfrais/creation_fraishorsforfait', 'Gererfrais::valider_creation_fraishorsforfait');
$routes->get('Gererfrais/supp_fraishorsforfait/(:num)', 'Gererfrais::supprimer_fraishorsforfait/$1');

$routes->get('Etatfrais', 'Etatfrais::index');
$routes->post('Etatfrais/mois', 'Etatfrais::selectionner_mois');