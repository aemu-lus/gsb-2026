<?php

namespace App\Controllers;

class Accueil extends BaseController
{
    public function __construct()
    {
        // On charge le helper URL et HTML
        helper(['url', 'html']);
    }

    /** Méthode par défaut */
    public function index()
    {
        // Vérifie si l’utilisateur est connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $url = 'https://fr.motorsport.com/rss/motogp/news/';
        $xml =  simplexml_load_file($url);


        $tableau = array();
        $i = 0;
        foreach ($xml->channel->item as $item) {
            $lien = $item->link;
            $titre = $item->title;
            $desc = $item->description;
            $cate = $item->category;
            $date = $item->pubDate;
            $img = $item->enclosure['url'];
            $tableau[$i] = array(
                'title' => $titre,
                'link' => $lien,
                'description' => $desc,
                'category' => $cate,
                'pubDate' => $date,
                'image' => $img
                // 'description' => $xml->channel->item->description, 
                // 'category' => $xml->channel->item->category,
                // 'pubDate' => $xml->channel->item->pubDate
            );
            $i++;
        }

        $data = [
            'titre' => "Bienvenue sur l'intranet GSB",
            'rss' => $tableau,
            //'menuItems' => 
            
        ];




        return view('structures/page_entete')
            . view('structures/messages')
            . view('sommaire')
            . view('structures/contenu_entete', $data)
            . view('rss', $data)
            . view('structures/page_pied');
    }
}
