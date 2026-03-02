<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\PriceProductMerchantRelationshipMerchantPortalGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\PriceProductMerchantRelationshipMerchantPortalGui\Dependency\Facade\PriceProductMerchantRelationshipMerchantPortalGuiToMerchantRelationshipFacadeBridge;
use Spryker\Zed\PriceProductMerchantRelationshipMerchantPortalGui\Dependency\Facade\PriceProductMerchantRelationshipMerchantPortalGuiToMerchantUserFacadeBridge;
use Spryker\Zed\PriceProductMerchantRelationshipMerchantPortalGui\Dependency\Facade\PriceProductMerchantRelationshipMerchantPortalGuiToTranslatorFacadeBridge;
use Spryker\Zed\PriceProductMerchantRelationshipMerchantPortalGui\Dependency\Service\PriceProductMerchantRelationshipMerchantPortalGuiToUtilEncodingServiceBridge;

/**
 * @method \Spryker\Zed\PriceProductMerchantRelationshipMerchantPortalGui\PriceProductMerchantRelationshipMerchantPortalGuiConfig getConfig()
 */
class PriceProductMerchantRelationshipMerchantPortalGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_MERCHANT_RELATIONSHIP = 'FACADE_MERCHANT_RELATIONSHIP';

    /**
     * @var string
     */
    public const FACADE_MERCHANT_USER = 'FACADE_MERCHANT_USER';

    /**
     * @var string
     */
    public const FACADE_TRANSLATOR = 'FACADE_TRANSLATOR';

    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addMerchantRelationshipFacade($container);
        $container = $this->addMerchantUserFacade($container);
        $container = $this->addTranslatorFacade($container);
        $container = $this->addUtilEncodingService($container);

        return $container;
    }

    protected function addMerchantRelationshipFacade(Container $container): Container
    {
        $container->set(static::FACADE_MERCHANT_RELATIONSHIP, function (Container $container) {
            return new PriceProductMerchantRelationshipMerchantPortalGuiToMerchantRelationshipFacadeBridge(
                $container->getLocator()->merchantRelationship()->facade(),
            );
        });

        return $container;
    }

    protected function addMerchantUserFacade(Container $container): Container
    {
        $container->set(static::FACADE_MERCHANT_USER, function (Container $container) {
            return new PriceProductMerchantRelationshipMerchantPortalGuiToMerchantUserFacadeBridge(
                $container->getLocator()->merchantUser()->facade(),
            );
        });

        return $container;
    }

    protected function addTranslatorFacade(Container $container): Container
    {
        $container->set(static::FACADE_TRANSLATOR, function (Container $container) {
            return new PriceProductMerchantRelationshipMerchantPortalGuiToTranslatorFacadeBridge(
                $container->getLocator()->translator()->facade(),
            );
        });

        return $container;
    }

    protected function addUtilEncodingService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_ENCODING, function (Container $container) {
            return new PriceProductMerchantRelationshipMerchantPortalGuiToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service(),
            );
        });

        return $container;
    }
}
