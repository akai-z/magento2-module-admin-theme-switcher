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
namespace Akai\AdminThemeSwitcher\Model\ResourceModel\Theme;

use Magento\Theme\Model\ResourceModel\Theme\Collection as ThemeCollection;
use Magento\Framework\Data\Collection as DataCollection;
use Magento\Framework\App\Area as AppArea;

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
