<?php

namespace Magebit\Learning\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Session;
use Magento\Eav\Model\Entity\Attribute\AbstractAttribute;
use Magento\Framework\Api\AttributeInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Block responsible for displaying attributes and short description of a product
 */
class AttributeElement extends Template
{
    /** @var ProductInterface|null */
    protected $_product = null;

    /**
     * @param Context
     * @param Session
     * @param ProductRepositoryInterface
     *
     * @return void
     * @throws NoSuchEntityException
     */
    public function __construct(
        Context $context,
        Session $catalogSession,
        ProductRepositoryInterface $productRepository,
    )
    {
        parent::__construct($context);
        // Get product instance
        $this->_product = $productRepository->getById($catalogSession->getData('last_viewed_product_id'));
    }

    /**
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->_product;
    }

    /**
     * @return array|mixed|string|null
     */
    public function attributeHasValue($code)
    {
        return $this->_product->getAttributeText($code);
    }

    /**
     * Returns attributes values as a single string
     *
     * @param string $separator
     * @param string $code
     *
     * @return string
     */
    public function getAttributeValue($separator, $code)
    {
        $values = $this->_product->getAttributeText($code);

        if(is_string($values))
        {
            return $values;
        }

        return implode($separator, $values);
    }

    /**
     * Returns the value of short_description attribute or an empty string if there is no value
     *
     * @return string
     */
    public function getShortDescription()
    {
        /** @var AttributeInterface $descriptionAttribute */
        $descriptionAttribute = $this->getProduct()->getCustomAttribute('short_description');

        if(!$descriptionAttribute)
        {
            return "";
        }

        return $descriptionAttribute->getValue();
    }

    /**
     * Returns an array of max 3 attributes or fewer. Dimensions, materials and color attributes are prioritized.
     * If some of the prioritized attributes are not found then other attributes are used to fill the 3 attribute limit.
     *
     * @return array
     */
    public function getAttributes()
    {
        $chosenAttributes = [];

        /** @var AbstractAttribute $attributes */
        $attributes = $this->getProduct()->getAttributes();

        if(!$attributes)
        {
            return $chosenAttributes;
        }

        foreach ($attributes as $attribute)
        {
            $code = $attribute->getAttributeCode();

            /** @var $attribute AbstractAttribute */
            if(!$attribute->getIsVisibleOnFront())
            {
                unset($attributes[$code]);
                continue;
            }

            if(!$this->attributeHasValue($code))
            {
                unset($attributes[$code]);
                continue;
            }

            if($code === "dimensions")
            {
                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue(" x ",$code),
                    'code' => $code
                ];

                unset($attributes[$code]);
            }

            if($code === "color")
            {
                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue("/",$code),
                    'code' => $code
                ];

                unset($attributes[$code]);
            }

            if($code === "material")
            {
                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue(", ",$code),
                    'code' => $code
                ];

                unset($attributes[$code]);
            }
        }

        if(count($chosenAttributes) < 3)
        {
            for ($i = 0; $i <= 3 - count($chosenAttributes); $i++)
            {
                if(empty($attributes))
                {
                    break;
                }

                $attribute = array_shift($attributes);
                $code = $attribute->getAttributeCode();

                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue(", ", $code),
                    'code' => $code
                ];
            }
        }

        return $chosenAttributes;
    }
}
