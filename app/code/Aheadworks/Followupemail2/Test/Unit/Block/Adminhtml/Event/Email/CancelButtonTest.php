<?php
/**
 * Copyright 2019 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Aheadworks\Followupemail2\Test\Unit\Block\Adminhtml\Event\Email;

use Aheadworks\Followupemail2\Block\Adminhtml\Event\Email\CancelButton;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 * Test for \Aheadworks\Followupemail2\Block\Adminhtml\Event\Email\CancelButton
 */
class CancelButtonTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CancelButton
     */
    private $button;

    /**
     * Init mocks for tests
     *
     * @return void
     */
    public function setUp()
    {
        $objectManager = new ObjectManager($this);
        $this->button = $objectManager->getObject(
            CancelButton::class,
            []
        );
    }

    /**
     * Test getButtonData method
     */
    public function testGetButtonData()
    {
        $this->assertTrue(is_array($this->button->getButtonData()));
    }
}
