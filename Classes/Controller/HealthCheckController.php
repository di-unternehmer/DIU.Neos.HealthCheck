<?php
namespace DIU\Neos\HealthCheck\Controller;

use Neos\Eel\FlowQuery\FlowQuery;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

/**
 * Controller for healthcheck
 *
 * @Flow\Scope("singleton")
 */
class HealthCheckController extends ActionController
{

    /**
     * @Flow\Inject
     * @var Neos\ContentRepository\Domain\Service\ContextFactoryInterface
     */
    protected $contextFactory;

    /**
     * @var string
     */
    protected $defaultViewObjectName = \Neos\Flow\Mvc\View\JsonView::class;

    public function checkAction()
    {
        $context = $this->contextFactory->create();
        $q = new FlowQuery([$context->getCurrentSiteNode()]);
        $q->get();
        $status = ['status' => 'OK'];
        $this->view->assign('value', $status);
    }

}
