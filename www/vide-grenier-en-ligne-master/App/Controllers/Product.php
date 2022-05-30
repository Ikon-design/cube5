<?php

namespace App\Controllers;

use App\Models\Articles;
use App\Models\Messages;
use App\Utility\Upload;
use \Core\View;

/**
 * Product controller
 */
class Product extends \Core\Controller
{

    /**
     * Affiche la page d'ajout
     * @return void
     */
    public function indexAction()
    {
        $error = '';

        if(isset($_POST['submit'])) {
            if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['city']) && !empty($_FILES['picture'])){


                try {
                    $f = [];
                    foreach ($_POST as $key => $value) {
                        $value = trim($value);
                        $value = stripslashes($value);
                        $f[$key] = htmlspecialchars($value);
                    }
                    
                    // TODO: Validation
                    
                    $f['user_id'] = $_SESSION['user']['id'];
                    $id = Articles::save($f);
                    
                    $pictureName = Upload::uploadFile($_FILES['picture'], $id);
                    
                    Articles::attachPicture($id, $pictureName);
                    
                    header('Location: /product/' . $id);
                } catch (\Exception $e){
                    var_dump($e);
                }
            }else{
                $error = 'Veuillez remplir tous les champs. (Bande de vilain hacker c\'est pas bien de modifier le code source)';
            }
        }

        View::renderTemplate('Product/Add.html', array('errorMessage' => $error));

    }

    /**
     * Affiche la page d'un produit
     * @return void
     */
    public function showAction()
    {
        $id = $this->route_params['id'];
        $error = '';

        if(isset($_POST['submit'])){
            if(!empty($_POST['mail']) && !empty($_POST['message'])){
            
                $article = Articles::getOne($id);
                $f = [
                    'mail' => $_POST['mail'],
                    'id_article' => $id,
                    'message' => $_POST['message'],
                    'id_receiver' => $article[0]['user_id']
                ];
                
                foreach ($f as $key => $value) {
                    $value = trim($value);
                    $value = stripslashes($value);
                    $f[$key] = htmlspecialchars($value);
                }

                Messages::createMessage($f);
            }else{
                $error = 'Veuillez remplir tous les champs. (Bande de vilain hacker c\'est pas bien de modifier le code source)';
            }
        }
        
        try {
            Articles::addOneView($id);
            $suggestions = Articles::getSuggest();
            $article = Articles::getOne($id);
        } catch(\Exception $e){
            var_dump($e);
        } 
        
        View::renderTemplate('Product/Show.html', [
            'article' => $article[0],
            'suggestions' => $suggestions,
            'errorMessage' => $error
        ]);
    }
}
