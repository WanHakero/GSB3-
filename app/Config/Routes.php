<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('Connexion', 'Home::connexion');
$routes->get('Connexion', 'Home::connexion');

$routes->post('Deconnexion', 'Home::deconnexion');
$routes->get('Deconnexion', 'Home::deconnexion');

$routes->get('Medicament', 'Medicament::indexFORM_Medicament');
$routes->get('MedicamentC', 'Medicament::choixMedicament');
$routes->post('MedicamentC', 'Medicament::choixMedicament');

$routes->get('Praticien', 'Praticien::indexFORM_Praticien');
$routes->post('Praticien', 'Praticien::indexFORM_Praticien');
$routes->get('PraticienP', 'Praticien::praticienPrecedent');
$routes->post('PraticienP', 'Praticien::praticienPrecedent');
$routes->get('PraticienS', 'Praticien::praticienSuivant');
$routes->post('PraticienS', 'Praticien::praticienSuivant');


$routes->get('Visiteur', 'Home::indexFORM_Visiteur');
$routes->get('RapportVisiteur', 'RapportVisite::indexRapport_Visiteur');
$routes->get('ModifierRapport', 'RapportVisite::modifierRapport');
$routes->post('ModifierRapport', 'RapportVisite::modifierRapport');


$routes->get('RapportVisiteurE', 'RapportVisite::envoyerRapport');
$routes->post('RapportVisiteurE', 'RapportVisite::envoyerRapport');

$routes->get('ConsulterCR', 'ConsulterCompteRendue::indexConsulter');

$routes->get('rechercheCR', 'ConsulterCompteRendue::consulte');
$routes->post('rechercheCR', 'ConsulterCompteRendue::consulte');

$routes->get('enSavoirPlus', 'ConsulterCompteRendue::enSavoirPlus');
$routes->post('enSavoirPlus', 'ConsulterCompteRendue::enSavoirPlus');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
