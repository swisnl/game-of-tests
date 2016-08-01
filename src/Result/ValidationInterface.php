<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 1-8-2016
 * Time: 14:11
 */
namespace Swis\GoT\Result;

use Swis\GoT\Settings;

interface ValidationInterface
{
    /**
     * Validation constructor.
     * @param \Swis\GoT\Settings $settings
     */
    public function __construct(Settings $settings);

    public function isValidFile($file);
}