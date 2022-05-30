<?php

namespace App\Controllers;

use App\Models\Articles;
use \Core\View;
use Exception;

/**
 * Home controller
 */
class Home extends \Core\Controller
{

    /**
     * Affiche la page d'accueil
     *
     * @return void
     * @throws \Exception
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html', []);
    }

    /**
     * Affiche la page d'accueil
     *
     * @return void
     * @throws \Exception
     */
    public function adminAction()
    {

        $user = \App\Models\User::getById($_SESSION['user']['id']);
        if($user['is_admin'] !== "1"){
            header('Location: /');

        }

        $nb_user = count(\App\Models\User::countUser());
        $articles = \App\Models\Articles::getAllCount();
        $nb_vue = 0;
        foreach ($articles as $key => $value) {
            $nb_vue += $value['views'];
        }
        $nb_articles = count($articles);
        $moy_vue = round($nb_vue / $nb_articles);
        $data = [
            'nb_user' => $nb_user,
            'nb_vue' => $nb_vue,
            'moy_vue' => $moy_vue,
            'nb_articles' => $nb_articles
        ];

        View::renderTemplate('Home/admin.html', array('data' => $data));

    }
}
