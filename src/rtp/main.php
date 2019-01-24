<?php
namespace rtp;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\level\Position;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
class main extends PluginBase implements Listener{
	public function onEnable() {
		$this->getLogger()->info('RTP Enabled');
	}
	public function onDisable() {
		$this->getLogger()->info('[RTP] Disable');
	}
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool{
		switch(strtolower($command->getName())) {
			case 'rtp':
				$x = mt_rand('-300', '5000');
				$y = mt_rand('70', '120');
				$z = mt_rand('-300', '5000');
				$sender->teleport(new Position($x, $y, $z));
				$togive = new EffectInstance(Effect::getEffect(11));
				$togive->setDuration(20*8);
				$togive->setAmplifier(20);
				$sender->addEffect($togive);
				$sender->sendMessage("§4You were confused and walked to nowhere");
				return true;
		}		
	}
}