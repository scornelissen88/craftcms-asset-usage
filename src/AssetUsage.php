<?php

namespace vrijdag\craftcmsassetusage;

use Craft;
use craft\base\Plugin;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class AssetUsage
 * @package vrijdag\craftcmsassetusage
 * @property \vrijdag\craftcmsassetusage\services\AssetUsage $assetUsage
 */
class AssetUsage extends Plugin
{
    /**
     * @var AssetUsage
     */
    public static $plugin;
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

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->setComponents([
            'assetUsage' => \vrijdag\craftcmsassetusage\services\AssetUsage::class,
        ]);

        Craft::$app->view->hook('cp.assets.edit.details', function(array &$context) {
            $asset = $context['element'] ?? null;
            $entries = [];

            if ($asset) {
                $entries = AssetUsage::getInstance()->getAssetUsage()->getUsageByAsset($asset);
            }

            return Craft::$app->getView()->renderTemplate('asset-usage/hooks/asset-usage', [
                'entries' => $entries,
            ]);
        });
    }

    /**
     * @return services\AssetUsage
     */
    public function getAssetUsage()
    {
        return $this->assetUsage;
    }
}
