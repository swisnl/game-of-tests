<?php
namespace Swis\GoT\Settings;

use Swis\GoT\Settings;

class Factory
{
    /**
     * @param bool $loadDefaultSettings Load default settings
     * @return \Swis\GoT\Settings|\Swis\GoT\Settings\DefaultSettings
     */
    public static function create($loadDefaultSettings = true)
    {
        if ($loadDefaultSettings === true) {
            return new DefaultSettings();
        }

        return new Settings();
    }
}