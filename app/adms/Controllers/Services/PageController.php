<?php 

namespace App\adms\Controllers\Services;

use App\adms\Helpers\ClearUrl;
use App\adms\Helpers\SlugController;

/**
 * Recebe a URL e manipula para onde sera enviado
 * 
 * @author Fabrício <fabricio.cecatto1@gmail.com>
 */
class PageController 
{
    /** @var string url Receber a URL do .htaccess */
    private string $url;
    
    private array $urlArray;

    private string $urlController = "";

    private string $urlParameter = "";

    /**
     * recebe a url do .htaccess
     */
    public function __construct()
    {
    
        
        //verifica se existe algo na url enviada
        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){

            //recebe o valor enviado
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            
            //chamar a clase helper para limpar a url
            $this->url = ClearUrl::clearUrl($this->url);
           

            //converte a string da url em array 
            $this->urlArray = explode("/", $this->url);
           

            if(isset($this->urlArray[0])){

                $this->urlController = SlugController::slugController($this->urlArray[0]);

                // $this->urlController = $this->urlArray[0];
            }else{
                $this->urlController = SlugController::slugController("Login");
            }

            if(isset($this->urlArray[1])){
                $this->urlParameter = $this->urlArray[1];
            } 

        }else{
            $this->urlController = SlugController::slugController($this->urlArray[0]);
        }

        
    }

    public function loadPage(): void 
    {
        $loadPageAdm = new LoadPageAdm();

        $loadPageAdm->loadPageAdm($this->urlController, $this->urlParameter);
    }

}