<?php
 class JFlipClock extends CWidget{
    public $autostart = false;
    public $time;
    
    
    public function init()
    {
      $this->registerCssScripts(); 
      $this->registerJsScripts();          
    }
    
    public function run()
    {
      $this->time = ''; 
      $this->render('index'); 
    }
    
    private function registerJsScripts(){
      $assetUrl = $this->publishAssets();
      Yii::app()->clientScript->registerCoreScript('jquery');
      Yii::app()->clientScript->registerScriptFile($assetUrl.'/js/flipclock/libs/prefixfree.min.js');
      Yii::app()->clientScript->registerScriptFile($assetUrl.'/js/flipclock/flipclock.min.js');
      Yii::app()->clientScript->registerCssFile($assetUrl.'/css/flipclock.css');
      Yii::app()->clientScript->registerCss('flip-li',"
      ul.flip li{
        line-height:87px;
      }
      ");
      $this->startFlippin();              
    }
    
    private function startFlippin(){
      Yii::app()->clientScript->registerScript('jflipclock-init',"
      var jflipclock = $('.jflipclock').FlipClock({
        autostart : true,
        clockFace: 'TwelveFourHourClock'  
      });
      jflipclock.setTime(".$this->getCurrentTimeInSecs().");
      ",CClientScript::POS_READY);
    }
    
    private function getCurrentTimeInSecs(){
      $now = time();
      $hour = date('h',$now);
      $mins = date('i',$now);
      $secs = date('s',$now);
      $inSeconds = ($hour * 3600) + ($mins * 60) + $secs + 5;      
      return $inSeconds;  
    }  
    
    private function registerCssScripts(){
      $baseUrl = Yii::app()->baseUrl;   
    }
    
    private function publishAssets()
  	{
  		$path = Yii::getPathOfAlias('ext.jflipclock.assets');
  		return  Yii::app()->assetManager->publish($path);
  	}
 }
?>