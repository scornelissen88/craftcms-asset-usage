<?php

namespace vrijdag\craftcmsassetusage\services;

use craft\base\Component;
use craft\elements\Asset;
use craft\elements\Entry;

class AssetUsage extends Component
{
    private const ENTRY_STATUS_DRAFT = 1;
    private const ENTRY_STATUS_TRASHED = 2;

    /**
     * @param Asset $asset
     * @return Entry[]
     */
    public function getUsageByAsset(Asset $asset)
    {
        return array_merge(
            $this->_getRelatedEntries($asset),
            $this->_getRelatedEntries($asset, self::ENTRY_STATUS_DRAFT),
            $this->_getRelatedEntries($asset, self::ENTRY_STATUS_TRASHED)
        );
    }

    /**
     * @param Asset $asset
     * @param int|null $entryStatus
     * @return Entry[]
     */
    private function _getRelatedEntries(Asset $asset, ?int $entryStatus = null): array
    {
        $entryQuery = Entry::find()
            ->relatedTo($asset)
            ->anyStatus();

        switch ($entryStatus) {
            case self::ENTRY_STATUS_DRAFT:
                $entryQuery->drafts(true);

                break;
            case self::ENTRY_STATUS_TRASHED:
                $entryQuery->trashed(true);

                break;
        }

        return $entryQuery->all();
    }
}