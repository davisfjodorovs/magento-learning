<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Widget\Controller\Adminhtml;

/**
 * @magentoAppArea Adminhtml
 */
class WidgetTest extends \Magento\TestFramework\TestCase\AbstractBackendController
{
    /**
     * Partially covers \Magento\Widget\Block\Adminhtml\Widget\Options::_addField()
     */
    public function testLoadOptionsAction()
    {
        $this->getRequest()->setParam(
            'widget',
            '{"widget_type":"Magento\\\\Cms\\\\Block\\\\Widget\\\\ExampleViewModel\\\\Link","values":{}}'
        );
        $this->dispatch('backend/admin/widget/loadOptions');
        $output = $this->getResponse()->getBody();
        //searching for label with text "CMS ExampleViewModel"
        $this->assertStringContainsString(
            'data-ui-id="wysiwyg-widget-options-fieldset-element-label-parameters-page-id-label" >' . '<span>CMS ExampleViewModel',
            $output
        );
    }
}
