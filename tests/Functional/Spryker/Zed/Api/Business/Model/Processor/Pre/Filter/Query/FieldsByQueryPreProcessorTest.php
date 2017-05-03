<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Query;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ApiFilterTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Query\FieldsByQueryPreProcessor;

/**
 * @group Functional
 * @group Spryker
 * @group Zed
 * @group Api
 * @group Business
 * @group Model
 * @group Processor
 * @group Pre
 * @group Filter
 * @group Query
 * @group FieldsByQueryPreProcessorTest
 */
class FieldsByQueryPreProcessorTest extends Test
{

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testProcessEmpty()
    {
        $config = new ApiConfig();
        $processor = new FieldsByQueryPreProcessor($config);

        $apiRequestTransfer = new ApiRequestTransfer();
        $apiRequestTransfer->setFilter(new ApiFilterTransfer());

        $apiRequestTransferAfter = $processor->process($apiRequestTransfer);
        $this->assertSame([], $apiRequestTransferAfter->getFilter()->getFields());
    }

    /**
     * @return void
     */
    public function testProcess()
    {
        $config = new ApiConfig();
        $processor = new FieldsByQueryPreProcessor($config);

        $apiRequestTransfer = new ApiRequestTransfer();
        $apiRequestTransfer->setFilter(new ApiFilterTransfer());
        $apiRequestTransfer->setQueryData([
            FieldsByQueryPreProcessor::FIELDS => 'one,two,three',
        ]);

        $apiRequestTransferAfter = $processor->process($apiRequestTransfer);
        $expected = [
            'one',
            'two',
            'three',
        ];
        $this->assertSame($expected, $apiRequestTransferAfter->getFilter()->getFields());
    }

}