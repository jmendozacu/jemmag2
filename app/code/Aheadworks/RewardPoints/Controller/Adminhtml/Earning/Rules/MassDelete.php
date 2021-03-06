<?php
/**
 * Copyright 2019 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Aheadworks\RewardPoints\Controller\Adminhtml\Earning\Rules;

use Aheadworks\RewardPoints\Api\EarnRuleRepositoryInterface;
use Aheadworks\RewardPoints\Model\ResourceModel\EarnRule\CollectionFactory as EarnRuleCollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 * @package Aheadworks\RewardPoints\Controller\Adminhtml\Earning\Rules
 */
class MassDelete extends Action
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Aheadworks_RewardPoints::aw_reward_points_earning_rules';

    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var EarnRuleCollectionFactory
     */
    private $ruleCollectionFactory;

    /**
     * @var EarnRuleRepositoryInterface
     */
    private $ruleRepository;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param EarnRuleCollectionFactory $ruleCollectionFactory
     * @param EarnRuleRepositoryInterface $ruleRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        EarnRuleCollectionFactory $ruleCollectionFactory,
        EarnRuleRepositoryInterface $ruleRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->ruleCollectionFactory = $ruleCollectionFactory;
        $this->ruleRepository = $ruleRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->ruleCollectionFactory->create());
            $count = 0;
            foreach ($collection->getAllIds() as $ruleId) {
                $this->ruleRepository->deleteById($ruleId);
                $count++;
            }
            if ($count) {
                $this->messageManager->addSuccessMessage(__('A total of %1 rule(s) were deleted.', $count));
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
