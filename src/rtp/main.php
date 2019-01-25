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
use pocketmine\utils\Config;
class main extends PluginBase implements Listener{
	/** @var Config */
    public $Config;
	public function onEnable() {
		@mkdir($this->getDataFolder());
		$this->saveResource("config.yml");
		$this->Config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->getLogger()->info('RTP Enabled');
	}
	public function onDisable() {
		$this->getLogger()->info('RTP Disabled');
	}
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool{
		switch(strtolower($command->getName())) {
			case 'rtp':
				if($sender->hasPermission("rtp")){
					for ($wait = $this->getConfig()->get("waittime") ; $wait > 0 ; $wait--){
						$sender->sendMessage("Waiting for $wait more second(s)");
						sleep(1);
					}
					$x = mt_rand('-300', '5000');
					$y = mt_rand('70', '120');
					$z = mt_rand('-300', '5000');
					$sender->teleport(new Position($x, $y, $z));
					$togive = new EffectInstance(Effect::getEffect(11));
					$togive->setDuration(20*$this->getConfig()->get("resistsec"));
					$togive->setAmplifier(20);
					$sender->addEffect($togive);
					$sender->sendMessage($this->getConfig()->get("message"));
				}
		}
		return true;	
	}
}