<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Sales\Block\Adminhtml\Order\Create\Billing;

use Magento\Customer\Model\Address\AddressModelInterface;
use Magento\Framework\View\Element\BlockInterface;
use Magento\Sales\Block\Adminhtml\Order\Create\AbstractAddressFormTest;
use Magento\Sales\Block\Adminhtml\Order\Create\Shipping\Address;

/**
 * Class checks billing address form behaviour
 *
 * @magentoAppArea Adminhtml
 * @magentoDbIsolation enabled
 *
 */
class FormTest extends AbstractAddressFormTest
{
    /**
     * @magentoDataFixture Magento/Checkout/_files/quote_with_address_saved.php
     *
     * @return void
     */
    public function testFormValuesExist(): void
    {
        $this->checkFormValuesExist(1);
    }

    /**
     * @magentoDataFixture Magento/Checkout/_files/quote_with_customer_without_address.php
     *
     * @return void
     */
    public function testFormValuesAreEmpty(): void
    {
        $this->checkFormValuesAreEmpty(1);
    }

    /**
     * @inheritdoc
     */
    protected function getFormBlock(): BlockInterface
    {
        return $this->layout->createBlock(Address::class);
    }

    /**
     * @inheritdoc
     */
    protected function getAddress(int $customerId): AddressModelInterface
    {
        return $this->customerRegistry->retrieve($customerId)->getDefaultBillingAddress();
    }
}
