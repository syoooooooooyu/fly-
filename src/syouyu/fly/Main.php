<?php

/**
 *    ＿＿＿＿＿   _     ＿   ＿　　  ＿　＿　
 *   /  ＿＿＿/\ //＿＿ | |  | |\  / /|  | |
 *   \＿＿＿＿\ \// ＿  \ |  | | \/ / |  | |
 *    ＿＿＿  \  / |＿| | |__| |   /| \__/ |
 *   /＿＿＿＿/　/\＿＿＿/\_____/  / \_____/
 *          /＿/            　 /__/
 *
 * @author Syouyu(syoooooooooyu)
 * @link https://github.com/syoooooooooyu/
 */

namespace syouyu\fly;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\entity\Entity;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

	private $fly;

	private $k;

	private $b;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $event){
		$this->fly[$event->getPlayer()->getName()] = false;
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		switch($command->getName()){
			case "fly":
				if(!isset($args[0])){
					if($this->b["fly"] == false){
						return true;
					}
					$bool = !$this->fly[$sender->getName()];
					$this->fly[$sender->getName()] = $bool;
					$a = $bool ? "有効" : "無効";
					$sender->sendMessage("flyが".$a."になりました。");
					$sender->setAllowFlight($bool);
					$sender->setFlying($bool);
				}else{
				    switch($args[0]) {
						case "y":
							if ($sender->isOp()) {
								$this->b["fly"] = true;
							}
							break;
						case "n":
							if ($sender->isOp()) {
								$this->b["fly"] = false;
							}
						break;
						case "k":
							if($this->k[$sender->getName()] == true){
								$bool = !$this->fly[$sender->getName()];
								$this->fly[$sender->getName()] = $bool;
								$a = $bool ? "有効" : "無効";
								$sender->sendMessage("flyが".$a."になりました。");
								$sender->setAllowFlight($bool);
								$sender->setFlying($bool);
							}
						break;
						case "namey":
							if($sender->isOp()){
								if(isset($args[1])){
									$player = Server::getInstance()->getPlayer($args[1]);
									$this->k[$player->getName()] = true;
									$sender->sendMessage("操作が終了しました");
								}
							}
						break;
						case "namen":
							if($sender->isOp()){
								if(isset($args[1])){
									$player = Server::getInstance()->getPlayer($args[1]);
									$this->k[$player->getName()] = false;
									$sender->sendMessage("操作が終了しました");
								}
							}
						break;
					}
				}
			break;
		}
		return true;
	}
}
