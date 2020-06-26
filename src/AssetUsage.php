<?php
/**
 * Asset Usage plugin for Craft CMS 3.x
 *
 * Show usage of assets on elements
 *
 * @link      https://vrijdag.digital
 * @copyright Copyright (c) 2020 Stefan
 */

namespace vrijdag\craftcmsassetusage;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class AssetUsage
 *
 * @author    Stefan
 * @package   AssetUsage
 * @since     1.0.0
 *
 */
class AssetUsage extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var AssetUsage
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'asset-usage',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
