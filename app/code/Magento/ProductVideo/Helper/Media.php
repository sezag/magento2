<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\ProductVideo\Helper;

use Magento\Framework\App\Area;
use Magento\Framework\View\ConfigInterface;
use Magento\Framework\View\DesignInterface;

/**
 * Helper to get attributes for video
 *
 */
class Media extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Catalog Module
     */
    const MODULE_NAME = 'Magento_ProductVideo';

    /**
     * Video play attribute
     */
    const NODE_CONFIG_NAME_VIDEO_PLAY = 'video_play';

    /**
     * Video stop attribute
     */
    const NODE_CONFIG_NAME_VIDEO_STOP = 'video_stop';

    /**
     * Video color attribute
     */
    const NODE_CONFIG_NAME_VIDEO_BACKGROUND = 'video_background';

    /**
     * @var ConfigInterface
     */
    protected $viewConfig;

    /**
     * Theme
     *
     * @var DesignInterface
     */
    protected $currentTheme;

    /**
     * Cached video config
     */
    protected $cachedVideoConfig;

    /**
     * @param ConfigInterface $configInterface
     * @param DesignInterface $designInterface
     */
    public function __construct(
        ConfigInterface $configInterface,
        DesignInterface $designInterface
    ) {
        $this->viewConfig = $configInterface;
        $this->currentTheme = $designInterface->getDesignTheme();
        $this->initConfig();
    }

    /**
     * Cached video config
     *
     * @return $this
     */
    protected function initConfig()
    {
        if ($this->cachedVideoConfig === null) {
            $this->cachedVideoConfig = $this->viewConfig->getViewConfig(
                [
                    'area' => Area::AREA_FRONTEND,
                    'themeModel' => $this->currentTheme
                ]
            );
        }

        return $this;
    }

    /**
     * Get video play params for player
     *
     * @return mixed
     */
    public function getVideoPlayAttribute()
    {
        return $this->cachedVideoConfig->getVideoAttributeValue(self::MODULE_NAME, self::NODE_CONFIG_NAME_VIDEO_PLAY);
    }

    /**
     * Get video stop params for player
     *
     * @return mixed
     */
    public function getVideoStopAttribute()
    {
        return $this->cachedVideoConfig->getVideoAttributeValue(self::MODULE_NAME, self::NODE_CONFIG_NAME_VIDEO_STOP);
    }

    /**
     * Get video color params for player
     *
     * @return mixed
     */
    public function getVideoBackgroundAttribute()
    {
        return $this->cachedVideoConfig->getVideoAttributeValue(self::MODULE_NAME, self::NODE_CONFIG_NAME_VIDEO_BACKGROUND);
    }

}
