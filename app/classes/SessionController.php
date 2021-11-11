<?php
class SessionController extends Controller{
    private $userSession;
    private $username;
    private $userid;
    private $session;
    private $sites;

    function __construct(){
        parent::__construct();
        $this->init();
    }
    public function getUserSession(){   return $this->userSession; }
    public function getUsername(){      return $this->username; }
    public function getUserId(){        return $this->userid; }

    private function init(){
        $this->session = new Session();
        $json = $this->getJSONFileConfig();
        
        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];
        $this->validateSession();
    }
    private function getJSONFileConfig(){
        $string = file_get_contents('src/access.json');
        $json = json_decode($string, true);
        return $json;
    }
    private function validateSession(){
        if($this->existsSession()){
            $role = ($this->getUserSessionData())['role'];
            if($this->isPublic()){
                $this->redirectDefaultSiteByRole($role);
            } 
            else{
                if($this->isAuthorized($role)){

                }
                else{
                    $this->redirectDefaultSiteByRole($role);
                } 
            }
        }else{
            if($this->isPublic()){

            }
            else{
                $separar = explode('/',$_SERVER["REQUEST_URI"]);
                if(!strpos($separar[2], '==')) $this->viewRedirect('',[]);
            }
        }
    }
    private function existsSession(){
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;
        $userid = $this->session->getCurrentUser();
        if($userid) return true;
        return false;
    }
    public function getUserSessionData(){
        $id = $this->session->getCurrentUser();
        $usuarioModel = new Signup();
        $array = ["id"=>$id];
        $lista = $usuarioModel->where($array)->first();
        return $lista;
    }
    private function isPublic(){
        $currentURL = $this->getCurrentPage();
        for ($i=0; $i < sizeof($this->sites); $i++)
            if($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['access']=='public') return true;
        return false;
    }
    private function getCurrentPage(){
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', trim($actualLink));
        return $url[2];
    }
    private function redirectDefaultSiteByRole($role){
        $url = '';
        for ($i=0; $i < sizeof($this->sites); $i++) { 
            if($this->sites[$i]['role'] == $role){
                $url = $this->sites[$i]['site'];
                break;
            }
        }
        $this->viewRedirect($url,[]);
    }
    private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        for($i=0; $i<sizeof($this->sites); $i++) { 
            if($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['role']==$role)
                return true;
        }
        return false;
    }
    public function initialize($user){
        $id = $user['id'];
        $this->session->setCurrentUser($id);
        $this->authorizeAccess($user['role']);
    }
    private function authorizeAccess($role){
        switch ($role) {
            case 'user':
                $this->viewRedirect($this->defaultSites['user']);
                break;
            case 'admin':
                $this->viewRedirect($this->defaultSites['admin']);
                break;
        }
    }
    public function logout(){
        $this->session->closeSession();
    }
}