<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Api;

use Spryker\Zed\Api\Business\Model\Processor\Post\Action\AddActionPostProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Post\Action\DeleteActionPostProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Action\AddActionPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Action\FindActionPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Action\GetActionPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Action\UpdateActionPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Fields\FieldsByQueryPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\FilterPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Header\PaginationByHeaderFilterPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Query\CriteriaByQueryFilterPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Query\PaginationByQueryFilterPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Query\SortByQueryFilterPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Format\FormatTypeByPathPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Format\FormatTypeByHeaderPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\PaginationPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\PathPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Resource\ResourceActionPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Resource\ResourceParametersPreProcessor;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Resource\ResourcePreProcessor;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ApiConfig extends AbstractBundleConfig
{

    const ROUTE_PREFIX_API_REST = '/api/rest/';

    const FORMAT_TYPE = 'json';

    /**
     * Stack of plugins to be used for filtering, pagination and alike in use with find() index method.
     *
     * @return array
     */
    public function getPreProcessorStack()
    {
        return [
            PathPreProcessor::class,
            FormatTypeByHeaderPreProcessor::class,
            FormatTypeByPathPreProcessor::class,
            ResourcePreProcessor::class,
            ResourceActionPreProcessor::class,
            ResourceParametersPreProcessor::class,
            FilterPreProcessor::class,
            PaginationPreProcessor::class,
            FieldsByQueryPreProcessor::class,
            SortByQueryFilterPreProcessor::class,
            CriteriaByQueryFilterPreProcessor::class,
            PaginationByQueryFilterPreProcessor::class,
            PaginationByHeaderFilterPreProcessor::class,
            AddActionPreProcessor::class,
            UpdateActionPreProcessor::class,
            GetActionPreProcessor::class,
            FindActionPreProcessor::class,
        ];
    }

    /**
     * Stack of plugins to be used for output processing of the final transfer with find() index method.
     *
     * @return array
     */
    public function getPostProcessorStack()
    {
        return [
            AddActionPostProcessor::class,
            DeleteActionPostProcessor::class,
            // CustomHeader
            // DateTimeFormat
        ];
    }

    /**
     * @return int
     */
    public function getLimitPerPage()
    {
        return 20;
    }

    /**
     * @return int
     */
    public function getMaxLimitPerPage()
    {
        return 100;
    }

    /**
     * @param string $resource
     *
     * @return array
     */
    public function getFields($resource)
    {
        $map = $this->getFieldMap();

        return $map[$resource];
    }

    /**
     * Whitelist of fields per resource.
     *
     * @return array
     */
    protected function getFieldMap()
    {
        return [
            'users' => [],
            'customers' => ['id', 'name'], // no password
        ];
    }

}
