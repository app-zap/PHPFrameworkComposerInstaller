<?php
namespace AppZap\PHPFrameworkComposerInstaller;

use AppZap\PHPFrameworkComposerInstaller\Util\Filesystem;
use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface, EventSubscriberInterface {

  public function activate(Composer $composer, IOInterface $io) {
  }

  public static function getSubscribedEvents() {
    return [
      ScriptEvents::POST_AUTOLOAD_DUMP => 'postAutoload',
    ];
  }

  /**
   * @param \Composer\Script\Event $event
   */
  public function postAutoload(Event $event) {
    $this->recursiveCopy(
      dirname(__DIR__ . '/../Boilerplate/*'),
      '.'
    );
  }

  /**
   * @param string $source
   * @param string $destination
   */
  protected function recursiveCopy($source, $destination) {
    $dir = opendir($source);
    @mkdir($destination);
    while (false !== ($file = readdir($dir))) {
      if (($file != '.') && ($file != '..')) {
        if (is_dir($source . '/' . $file)) {
          $this->recursiveCopy($source . '/' . $file, $destination . '/' . $file);
        } else {
          copy($source . '/' . $file, $destination . '/' . $file);
        }
      }
    }
    closedir($dir);
  }

}
