<?php
/**
 * See COPYING.txt for license details.
 */
namespace Akai\AdminThemeSwitcher\Model\Design\Backend;

use Akai\AdminThemeSwitcher\Model\Config;
use Magento\Framework\App\Area as AppArea;
use Magento\Framework\App\Cache\TypeListInterface as CacheTypeList;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Framework\App\Config\Value as ConfigValue;
use Magento\Framework\Data\Collection\AbstractDb as ResourceCollection;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource as Resource;
use Magento\Framework\Registry;
use Magento\Framework\View\DesignInterface as ViewDesign;

class Theme extends ConfigValue
{
    /**
     * Design package instance.
     *
     * @var ViewDesign
     */
    private $design = null;

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfig $scopeConfig,
        CacheTypeList $cacheTypeList,
        ViewDesign $design,
        Config $config,
        Resource $resource = null,
        ResourceCollection $resourceCollection = null,
        array $data = []
    ) {
        $this->design = $design;
        $this->config = $config;

        parent::__construct(
            $context,
            $registry,
            $scopeConfig,
            $cacheTypeList,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @return Theme
     */
    public function beforeSave()
    {
        $this->setDesignTheme();
        return parent::beforeSave();
    }

    /**
     * {@inheritDoc}
     * In addition, it sets status 'invalidate' for blocks and other output caches.
     *
     * @return Theme
     */
    public function afterSave()
    {
        $this->invalidateCache();
        return parent::afterSave();
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->getData('value') !== null ? $this->getData('value') : '';
    }

    private function setDesignTheme()
    {
        $theme = $this->getValue();

        if ($theme) {
            // Validate specified value against admin area.
            $design = clone $this->design;
            $design->setDesignTheme($theme, AppArea::AREA_ADMINHTML);
        }
    }

    private function invalidateCache()
    {
        if ($this->isValueChanged()) {
            $this->cacheTypeList->invalidate($this->config->getDesignInvalidCaches());
        }
    }
}
