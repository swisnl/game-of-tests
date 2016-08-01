<?php
namespace Swis\GoT\Result;

use Swis\GoT\Result;
use Swis\GoT\Settings;

class Validation implements ValidationInterface
{
    /**
     * @var \Swis\GoT\Settings
     */
    protected $settings;

    /**
     * Validation constructor.
     * @param \Swis\GoT\Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function isValidFile($file)
    {
        foreach ($this->settings->getSkipPaths() as $path) {
            if (strpos($file, $path) === 0) {
                return false;
            }
        }
        return true;
    }

}