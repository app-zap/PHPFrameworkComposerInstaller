<?php
namespace AppZap\PHPFrameworkComposerInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Composer\Util\Filesystem;

class Plugin implements PluginInterface {

  protected function recurse_copy($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
      if (( $file != '.' ) && ( $file != '..' )) {
        if ( is_dir($src . '/' . $file) ) {
          $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
        }
        else {
          copy($src . '/' . $file,$dst . '/' . $file);
        }
      }
    }
    closedir($dir);
  }

  public function activate(Composer $composer, IOInterface $io) {
    $this->recurse_copy(dirname(__DIR__ . '/../Boilerplate/*'), '.');
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
