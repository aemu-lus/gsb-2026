<?php

namespace App\Controllers;

use App\Models\GsbModel;
use App\Libraries\Gsb_lib;

class Rembourserfrais extends BaseController
{
    protected Gsb_lib $gsb_lib;
    protected GsbModel $gsb_model;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->gsb_lib = new Gsb_lib();
        $this->gsb_model = new GsbModel();
    }

    public function index(?string $idFiche = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        if (empty($idFiche)) {
            return redirect()->to('Rembourserfiches')->with('erreurs', 'Aucune fiche sélectionnée.');
        }

        $detailFiche = $this->gsb_model->get_les_infos_ficheFrais($idFiche);
        if (!$detailFiche) {
            return redirect()->to('Rembourserfiches')->with('erreurs', 'Fiche de frais introuvable.');
        }

        $detailFiche['dateModifFr'] = $this->gsb_lib->date_vers_francais($detailFiche['dateModif']);
        $detailFiche['montantFormate'] = $this->gsb_lib->format_montant($detailFiche['montantValide']);

        $listeFraisHorsForfait = $this->gsb_model->get_les_frais_hors_forfait($idFiche);
        foreach ($listeFraisHorsForfait as &$fraisHF) {
            $fraisHF['dateFraisFR'] = $this->gsb_lib->date_vers_francais($fraisHF['dateFrais']);
            $fraisHF['montantFormate'] = $this->gsb_lib->format_montant($fraisHF['montant']);
        }
        unset($fraisHF);

        $data = [
            'titre' => 'Détail de la fiche de frais',
            'sc_titre' => 'Fiche n°' . $idFiche,
            'fiche' => $detailFiche,
            'idFiche' => $idFiche,
            'fraisforfait' => $this->gsb_model->get_les_frais_forfait($idFiche),
            'fraishorsforfait' => $listeFraisHorsForfait,
            'actionRemboursement' => site_url('Rembourserfrais/rembourser/' . $idFiche),
        ];

        echo view('structures/page_entete');
        echo view('structures/messages');
        echo view('sommaire');
        echo view('structures/contenu_entete', $data);
        echo view('structures/souscontenu_entete', $data);
        echo view('etat_fiche', $data);
        echo view('fraisforfait_table', $data);
        echo view('fraishorsforfait_table', $data);
        echo view('structures/souscontenu_pied');
        echo view('structures/page_pied');
    }

    public function rembourser(string $idFiche)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $fiche = $this->gsb_model->get_les_infos_ficheFrais($idFiche);
        if (!$fiche) {
            return redirect()->to('Rembourserfiches')->with('erreurs', 'Fiche de frais introuvable.');
        }

        if ($fiche['idEtat'] === 'VA') {
            $this->gsb_model->maj_etat_fiche_frais($idFiche, 'CL');
            return redirect()->to('Rembourserfiches')->with('succes', 'La fiche a bien été remboursée (état CL).');
        }

        return redirect()->to('Rembourserfrais/' . $idFiche)->with('erreurs', 'Seule une fiche validée (VA) peut être remboursée.');
    }
}
