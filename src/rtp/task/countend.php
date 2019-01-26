<?php

namespace rtp\task;
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
use pocketmine\utils\Config;
use pocketmine\scheduler\Task;
use pocketmine\entity\EffectInstance;
use rtp\main;

class countend extends Task{

    public function __construct(Main $plugin, $sender)
    {   
        $this->close = false;
        $this->plugin = $plugin;
        $this->sender = $sender;
        $this->iseconds = 0;
    }

    public function close()
    {
        $this->iseconds = 0;
        $this->close = true;
    }

    public function onRun($tick)
    {

            if(($this->iseconds)===($this->plugin->getConfig()->get("waittime"))) {
				$x = mt_rand('-300', '5000');
				$y = mt_rand('70', '120');
				$z = mt_rand('-300', '5000');
				$this->sender->teleport(new Position($x, $y, $z));
				$togive = new EffectInstance(Effect::getEffect(11));
				$togive->setDuration(20*$this->plugin->getConfig()->get("resistsec"));
				$togive->setAmplifier(20);
				$this->sender->addEffect($togive);
                $this->sender->sendMessage($this->plugin->getConfig()->get("message"));
                $this->plugin->removeTask($this->getTaskId());
            }
            $this->iseconds++;
        }
}