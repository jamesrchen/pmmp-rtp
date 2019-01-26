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
use rtp\task\countend;

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
					$sender->sendMessage("Waiting for ". $this->getConfig()->get("waittime") ." second(s)");
					$this->getScheduler()->scheduleRepeatingTask(new countend($this, $sender), 1 * 20);
				}
		}
		return true;	
	}
	public function removeTask($id) {
		$this->getScheduler()->cancelTask($id);
	}
}

