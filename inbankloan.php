<?php

if(!defined('_PS_VERSION_')){
    exit;
}

class InBankLoan extends Module{
    public function __construct(){
        $this->name = 'inbankloan';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Naglis Mockevicius';
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);

        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->displayName = $this->l('Paskolos skaičiuoklė');
        $this->description = $this->l('21 amžiaus šilko kelias');
        parent::__construct();
    }

    public function install(){
        return  parent::install() && $this->registerHook('displayProductAdditionalInfo');
        
        
        
    }
    public function uninstall(){
        return  parent::uninstall();
        
        
        
    }
    public function hookDisplayProductAdditionalInfo($params){
        $price = $params['product']['price'];
    $price = str_replace(",",".",$price);
    $price = str_replace("€","",$price);
    $price = ceil($price/10)*10;

        $html = '';
        $html .= '<iframe id="inbank-calculator" src="https://campaign.inbank.lv/calculators/hirepurchase/index_en.html?a=partner&b=1&c='.$price.'&s=white&d='.$price.'&e=1&f=6&g=3&h=1&i=0&j=90&k=0&l=5&m=20.9&n=5.5&o=0&p=0&q=1400&t-amount=2000&t-period=24&t-interest=20.9&t-commision=110&t-adminfee=0&t-total=1812&t-apr=1&r=Get%20your%20purchase%20now%20without%20any%20extra%20fees! "
            width="100%" height="300" frameborder="no" scrolling="no">
            </iframe>
            
            <script src="https://campaign.inbank.lv/calculators/hirepurchase/javascripts/iframeResizer.min.js"></script>
            <script>
            iFrameResize({}, "#inbank-calculator");
            </script>';
        return $html;
    }        
}
?>