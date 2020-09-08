<?php
/**
 * See COPYING.txt for license details.
 */
namespace Akai\AdminThemeSwitcher\Model\ResourceModel\Theme;

use Magento\Framework\App\Area as AppArea;
use Magento\Framework\Data\Collection as DataCollection;
use Magento\Theme\Model\ResourceModel\Theme\Collection as ThemeCollection;

class Collection extends ThemeCollection
{
    /**
     * @return Collection
     */
    public function loadRegisteredThemes()
    {
        $this->_reset()->clear();
        return $this->setOrder('theme_title', DataCollection::SORT_ORDER_ASC)
            ->filterVisibleThemes()->addAreaFilter(AppArea::AREA_ADMINHTML);
    }
}
