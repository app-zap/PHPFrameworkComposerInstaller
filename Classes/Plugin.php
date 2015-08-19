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
        ];
    }

    public function postInstall(Event $event) {
        echo 'caught event:' . $event->getName();
    }

}
