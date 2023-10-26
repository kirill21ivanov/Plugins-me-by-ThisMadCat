<?php
//19.10.2019 12:30
// Иванов.К
//19.10.2019 13:47

namespace ThisMadCat;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;
use pocketmine\block\Block;
use pocketmine\utils\Config;
use pocketmine\level\Level;
use pocketmine\tile\Sign;
use pocketmine\level\Position;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\math\Vector3;

Class TMC extends PluginBase {


  function onEnable()
  {
    $this->getLogger()->info('Plugin me() by ThisMadCat загружена');
    $this->getLogger()->info('Автор плагина - vk.com/kivanov20040');
    if(!$this->getServer()->getCommandMap()->getCommand("me") !== null){
      $this->getServer()->getCommandMap()->getCommand("me")->setLabel("null");
      $this->getServer()->getCommandMap()->getCommand("me")->unregister($this->getServer()->getCommandMap());
      //Это всё удаляет команду *me*
    }
    $this->getServer()->getCommandMap()->register("[me]", new MeCmd($this));
  }
}

 class MeCmd extends Command{
   public $cmd;
   public function __construct(TMC $d){
     parent::__construct("me", "Отыгровка команды от игрока", "me");
     $this->cmd = $d;
   }

   public function execute(CommandSender $p, $label, array $args) :bool{
     if(!isset($args[0])){
       $p->sendMessage("§7Использование: /me <отыгровка> *с маленькой буквы и точкой в конце.*");
     }
     if(isset($args[0])){
       switch($args[0]){
         case "0":
         $p->sendMessage("§7Нельзя писать 0 в чат /me");
         break;
         case "1":
         $p->sendMessage("§7Нельзя писать 1 в чат /me");
         break;
         default:
         foreach($this->cmd->getServer()->getOnlinePlayers() as $pl){
           if($p->distance($pl->asVector3()) < 8){
             $text = implode(" ", $args);
             $pl->sendMessage("§d" . $p->getName() . " " . $text . "");
           }
         }

         $text = implode(" ", $args);
         $p->sendPopup("");
         break;
       }
     }
   return false;}
 }
