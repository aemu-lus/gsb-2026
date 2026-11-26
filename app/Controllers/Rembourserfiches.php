<?php

namespace App\Controllers;

use App\Models\GsbModel;
use App\Libraries\Gsb_lib;

class Rembourserfiches extends BaseController
{
    protected Gsb_lib $gsb_lib;
    protected GsbModel $gsb_model;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->gsb_lib = new Gsb_lib();
        $this->gsb_model = new GsbModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $lesFiches = $this->gsb_model->get_les_infos_by_etat('VA');

        foreach ($lesFiches as &$fiche) {
            // Pour afficher la période (ex: "Août 2026") plutôt que dateModif si souhaité :
            $fiche['periodeFr'] = $this->gsb_lib->get_nom_mois($fiche['mois']) . ' ' . $fiche['annee'];
            $fiche['dateModifFr'] = $this->gsb_lib->date_vers_francais($fiche['dateModif']);
            $fiche['montantFormate'] = $this->gsb_lib->format_montant($fiche['montantValide']);
        }
        unset($fiche);

        $data = [
            'titre' => 'Suivi du remboursement des frais',
            'sc_titre' => 'Fiches de frais validées',
            'fiches' => $lesFiches,
        ];

        return view('structures/page_entete')
            . view('structures/messages')
            . view('sommaire')
            . view('structures/contenu_entete', $data)
            . view('structures/souscontenu_entete', $data)
            . view('remboursement', $data)
            . view('structures/souscontenu_pied')
            . view('structures/page_pied');
    }
}