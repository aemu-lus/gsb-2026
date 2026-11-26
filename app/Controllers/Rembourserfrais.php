<?php

namespace App\Controllers;

use App\Models\GsbModel;
use App\Libraries\Gsb_lib;

class Rembourserfrais extends BaseController
{
    private ?string $id_fiche;
    protected Gsb_lib $gsb_lib;
    protected GsbModel $gsb_model;

    public function __construct()
    {
        helper(['url', 'form']);

        $this->gsb_lib = new Gsb_lib();
        $this->gsb_model = new GsbModel();
    }

    /** Méthode par défaut */
    public function index()
    {
        // Vérifie si l’utilisateur est connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $this->fiches_frais = null;
        $this->id_fiche = null;
        return $this->commun();
    }

        /** Sélection d’un mois depuis la liste déroulante */
    public function selectionner_fiche()
    {
        $this->fiches_frais = $this->request->getPost('lstFiches');
        return $this->commun();
    }

    /** Traitement commun pour affichage de la page */
    private function commun()
    {
        echo view('structures/page_entete');
        echo view('structures/messages');
        echo view('sommaire');

        $data['titre'] = "Remboursement des fiches de frais";
        echo view('structures/contenu_entete', $data);

        // Récupération des fiches frais validées disponibles
        $les_fiches_frais = $this->gsb_model->get_les_infos_by_etat('VA');
        if (count($les_fiches_frais) == 0) {
            return redirect()->back()->withInput()->with('erreurs', "Il n'y a aucune fiche de frais validée.");
        } else {
            if (!isset($this->fiches_frais)) {
                $this->fiches_frais = $les_fiches_frais;
            }

            // Tableau des fiches de frais validées
            $options = [];

            $data['les_fiches_frais'] = $les_fiches_frais;
            
            $data['lst_contenu'] = $options;
            $data['lst_select'] = $this->fiches_frais;
            $data['lst_action'] = 'Rembourserfrais/id_fiche';
            $data['lst_id'] = 'lstFiches';
            $data['lst_label'] = 'Liste des fiches de frais validées';
            $data['sc_titre'] = 'La fiche à sélectionner :';
            echo view('structures/souscontenu_entete', $data);
            echo view('liste_deroulante', $data);
            echo view('structures/souscontenu_pied');

            // Pied de page
            echo view('structures/page_pied');
        }
    }
}