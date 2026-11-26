<?php

namespace App\Controllers;

use App\Models\GsbModel;
use App\Libraries\Gsb_lib;

class Rembourserfrais extends BaseController
{
    private ?string $annee_mois;
    private ?string $id_visiteur;
    private ?string $id_fiche;
    protected Gsb_lib $gsb_lib;
    protected GsbModel $gsb_model;

    public function __construct()
    {
        helper(['url', 'form']);

        $this->gsb_lib = new Gsb_lib();
        $this->gsb_model = new GsbModel();

        $this->id_visiteur = session()->get('idvisiteur');
    }

    /** Méthode par défaut */
    public function index()
    {
        // Vérifie si l’utilisateur est connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $this->annee_mois = null;
        $this->id_fiche = null;
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
            if (!isset($this->annee_mois)) {
                $this->annee_mois = $les_fiches_frais[0]['anneeMois'];
            }

            // Fiche sélectionnée
            $num_annee = $this->gsb_lib->get_annee_from_anneemois($this->annee_mois);
            $num_mois = $this->gsb_lib->get_mois_from_anneemois($this->annee_mois);
            $date_titre = $this->gsb_lib->get_nom_mois($num_mois) . " " . $num_annee;

            $data['sc_titre'] = 'Fiche de frais du mois de ' . $date_titre . ' :';

            echo view('structures/souscontenu_entete', $data);

            // Zone état
            $fiche = $this->gsb_model->get_id_ficheFrais($this->id_visiteur, $num_annee, $num_mois);
            $this->id_fiche = $fiche['idFiche'];
            $detailFiche = $this->gsb_model->get_les_infos_ficheFrais($this->id_fiche);
            $detailFiche['dateModifFr'] = $this->gsb_lib->date_vers_francais($detailFiche['dateModif']);
            $detailFiche['montantFormate'] = $this->gsb_lib->format_montant($detailFiche['montantValide']);
            $data['fiche'] = $detailFiche;
            $data['idFiche'] = $this->id_fiche;
            echo view('etat_fiche', $data);

            // Frais forfait
            $data['fraisforfait'] = $this->gsb_model->get_les_frais_forfait($this->id_fiche);
            echo view('fraisforfait_table', $data);

            // Frais hors forfait
            $listeFraisHorsForfait = $this->gsb_model->get_les_frais_hors_forfait($this->id_fiche);
            foreach ($listeFraisHorsForfait as &$fraisHF) {
                $fraisHF['dateFraisFR'] = $this->gsb_lib->date_vers_francais($fraisHF['dateFrais']);
                $fraisHF['montantFormate'] = $this->gsb_lib->format_montant($fraisHF['montant']);
            }
            unset($fraisHF);
            $data['fraishorsforfait'] = $listeFraisHorsForfait;
            echo view('fraishorsforfait_table', $data);

            echo view('structures/souscontenu_pied');

            // Pied de page
            echo view('structures/page_pied');
        }
    }
}
