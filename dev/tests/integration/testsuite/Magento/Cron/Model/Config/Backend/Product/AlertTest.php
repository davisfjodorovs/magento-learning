<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Cron\Model\Config\Backend\Product;

use Magento\Config\Model\Config as ConfigModel;
use Magento\Config\Model\PreparedValueFactory;
use Magento\Cron\Model\Config\Source\Frequency;
use Magento\Framework\App\Config\ValueFactory;
use Magento\Framework\ObjectManagerInterface;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

/**
 * @magentoAppArea Adminhtml
 */
class AlertTest extends TestCase
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        $this->objectManager = Bootstrap::getObjectManager();
    }

    /**
     * @dataProvider frequencyDataProvider
     * @param string $frequency
     * @param string $expectedCronExpr
     */
    public function testDirectSave(string $frequency, string $expectedCronExpr): void
    {
        $preparedValueFactory = $this->objectManager->get(PreparedValueFactory::class);
        /** @var Alert $sitemapValue */
        $alertValue = $preparedValueFactory->create('catalog/productalert_cron/frequency', $frequency, 'default', 0);
        $alertValue->save();

        self::assertEquals($expectedCronExpr, $this->getCronExpression());
    }

    /**
     * @dataProvider frequencyDataProvider
     * @param string $frequency
     * @param string $expectedCronExpr
     */
    public function testSaveFromAdmin(string $frequency, string $expectedCronExpr): void
    {
        $config = $this->objectManager->create(ConfigModel::class);
        $config->setSection('catalog');
        $config->setGroups(
            [
                'productalert_cron' => [
                    'fields' => [
                        'time' => ['value' => ['00', '00', '00']],
                        'frequency' => ['value' => $frequency],
                    ],
                ],
            ]
        );
        $config->save();

        self::assertEquals($expectedCronExpr, $this->getCronExpression());
    }

    /**
     * @return array
     */
    public function frequencyDataProvider(): array
    {
        return [
            'daily' => [Frequency::CRON_DAILY, '0 0 * * *'],
            'weekly' => [Frequency::CRON_WEEKLY, '0 0 * * 1'],
            'monthly' => [Frequency::CRON_MONTHLY, '0 0 1 * *'],
        ];
    }

    /**
     * @return string
     */
    private function getCronExpression(): string
    {
        $valueFactory = $this->objectManager->get(ValueFactory::class);
        $cronExprValue = $valueFactory->create()
            ->load(Alert::CRON_STRING_PATH, 'path');

        return $cronExprValue->getValue();
    }
}
