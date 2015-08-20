<?php
namespace AppZap\PHPFrameworkComposerInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface {

    public function activate(Composer $composer, IOInterface $io) {
        $io->write('activated');
    }

    public static function getSubscribedEvents() {
        return [
            ScriptEvents::POST_INSTALL_CMD => 'postInstall',
            ScriptEvents::POST_AUTOLOAD_DUMP => 'postAutoload',
        ];
    }

    /**
	 * @param \Composer\Script\Event $event
	 */
    public function postInstall(Event $event) {
        echo 'caught event:' . $event->getName();
    }
    
    /**
	 * @param \Composer\Script\Event $event
	 */
	public function postAutoload(Event $event) {
		echo 'caught event:' . $event->getName();
	}

}
