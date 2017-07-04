<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License version 2 (GPLv2).
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 *
 * @package   Akai\AdminThemeSwitcher
 * @author    Ammar K.
 * @copyright 2017 Akai-Z.
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License version 2 (GPLv2)
 * @see       https://api.github.com/user/4558603/
 */
namespace Akai\AdminThemeSwitcher\Model\Design\Backend;

use Magento\Framework\App\Config\Value as ConfigValue;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Store\Model\ScopeInterface as Scope;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Framework\App\Cache\TypeListInterface as CacheTypeList;
use Magento\Framework\View\DesignInterface as ViewDesign;
use Magento\Framework\Model\ResourceModel\AbstractResource as Resource;
use Magento\Framework\Data\Collection\AbstractDb as ResourceCollection;
use Magento\Framework\App\Area as AppArea;

class Theme extends ConfigValue
{
    /**
     * Path to config node with list of caches.
     */
    const XML_PATH_INVALID_CACHES = 'design/invalid_caches';

    /**
     * Design package instance.
     *
     * @var ViewDesign
     */
    private $design = null;

    /**
     * @param Context            $context
     * @param Registry           $registry
     * @param ScopeConfig        $config
     * @param CacheTypeList      $cacheTypeList
     * @param ViewDesign         $design
     * @param Resource           $resource
     * @param ResourceCollection $resourceCollection
     * @param array              $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfig $config,
        CacheTypeList $cacheTypeList,
        ViewDesign $design,
        Resource $resource = null,
        ResourceCollection $resourceCollection = null,
        array $data = []
    ) {
        $this->design = $design;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * Validate specified value against admin area.
     *
     * @return Theme
     */
    public function beforeSave()
    {
        if ('' != $this->getValue()) {
            $design = clone $this->design;
            $design->setDesignTheme($this->getValue(), AppArea::AREA_ADMINHTML);
        }

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

    private function invalidateCache()
    {
        $types = array_keys(
            $this->_config->getValue(
                self::XML_PATH_INVALID_CACHES,
                Scope::SCOPE_STORE
            )
        );

        if ($this->isValueChanged()) {
            $this->cacheTypeList->invalidate($types);
        }
    }
}
