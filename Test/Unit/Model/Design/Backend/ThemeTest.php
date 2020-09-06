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
namespace Akai\AdminThemeSwitcher\Test\Unit\Model\Design\Backend;

use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Store\Model\ScopeInterface as Scope;
use Magento\Theme\Model\Design\Backend\Theme;

class ThemeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Akai\AdminThemeSwitcher\Model\Design\Backend\Theme
     */
    private $model;

    /**
     * @var \Magento\Framework\Model\Context|\PHPUnit_Framework_MockObject_MockObject
     */
    private $contextMock;

    /**
     * @var \Magento\Framework\View\DesignInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $designMock;

    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $cacheTypeListMock;

    /**
     * @var ScopeConfig|\PHPUnit_Framework_MockObject_MockObject
     */
    private $configMock;

    /**
     * {@inheritDoc}
     *
     * @codingStandardsIgnoreStart
     */
    protected function setUp()
    {
        // @codingStandardsIgnoreEnd
        $this->contextMock = $this->getMockBuilder('Magento\Framework\Model\Context')
            ->disableOriginalConstructor()
            ->getMock();
        $this->designMock = $this->getMockBuilder('Magento\Framework\View\DesignInterface')->getMock();
        $this->cacheTypeListMock = $this->getMockBuilder('Magento\Framework\App\Cache\TypeListInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $this->contextMock->expects($this->once())
            ->method('getEventDispatcher')
            ->willReturn($this->getMockBuilder('Magento\Framework\Event\ManagerInterface')->getMock());
        $this->configMock = $this->getMockBuilder('Magento\Framework\App\Config\ScopeConfigInterface')->getMock();

        $this->model = (new ObjectManager($this))->getObject(
            'Akai\AdminThemeSwitcher\Model\Design\Backend\Theme',
            [
                'design' => $this->designMock,
                'context' => $this->contextMock,
                'cacheTypeList' => $this->cacheTypeListMock,
                'config' => $this->configMock,
            ]
        );
    }

    /**
     * @test
     *
     * @covers \Akai\AdminThemeSwitcher\Model\Design\Backend\Theme::beforeSave
     * @covers \Akai\AdminThemeSwitcher\Model\Design\Backend\Theme::__construct
     */
    public function testBeforeSave()
    {
        $this->designMock->expects($this->once())
            ->method('setDesignTheme')
            ->with('some_value', Area::AREA_ADMINHTML);
        $this->model->setValue('some_value');
        $this->assertInstanceOf(get_class($this->model), $this->model->beforeSave());
    }

    /**
     * @param int    $callNumber
     * @param string $oldValue
     *
     * @dataProvider afterSaveDataProvider
     */
    public function testAfterSave($callNumber, $oldValue)
    {
        $this->cacheTypeListMock->expects($this->exactly($callNumber))
            ->method('invalidate');
        $this->configMock->expects($this->any())
            ->method('getValue')
            ->willReturnMap(
                [
                    [
                        Theme::XML_PATH_INVALID_CACHES,
                        Scope::SCOPE_STORE,
                        null,
                        ['block_html' => 1, 'layout' => 1, 'translate' => 1]
                    ],
                    [
                        null,
                        ScopeConfig::SCOPE_TYPE_DEFAULT,
                        null,
                        $oldValue
                    ],

                ]
            );

        $this->model->setValue('some_value');
        $this->assertInstanceOf(get_class($this->model), $this->model->afterSave());
    }

    /**
     * @param string|null $value
     * @param string      $expectedResult
     *
     * @dataProvider getValueDataProvider
     */
    public function testGetValue($value, $expectedResult)
    {
        $this->model->setValue($value);
        $this->assertEquals($expectedResult, $this->model->getValue());
    }

    /**
     * @return array
     */
    public function getValueDataProvider()
    {
        return [
            [null, ''],
            ['value', 'value']
        ];
    }

    /**
     * @return array
     */
    public function afterSaveDataProvider()
    {
        return [
            [0, 'some_value'],
            [2, 'other_value']
        ];
    }
}
