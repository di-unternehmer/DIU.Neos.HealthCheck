<?php
namespace DIU\Neos\HealthCheck\Controller;

use Neos\Eel\FlowQuery\FlowQuery;
use Neos\Eel\FlowQuery\FlowQueryException;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Http\Component\SetHeaderComponent;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Mvc\Exception\NoSuchArgumentException;
use Neos\Flow\Property\PropertyMapper;
use Neos\Flow\Security\Authorization\PrivilegeManagerInterface;
use Neos\Flow\Session\Exception\SessionNotStartedException;
use Neos\Flow\Session\SessionInterface;
use Neos\Neos\Controller\Exception\NodeNotFoundException;
use Neos\Neos\Controller\Exception\UnresolvableShortcutException;
use Neos\Neos\Domain\Service\NodeShortcutResolver;
use Neos\Neos\Exception as NeosException;
use Neos\Neos\TypeConverter\NodeConverter;
use Neos\Neos\View\FusionView;
use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\ContentRepository\Domain\Service\ContextFactoryInterface;

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

        if(count($q->get()) > 0) {
            $status = ['status' => 'OK'];
        } else {
            $this->response->setStatusCode(500);
            $status = ['status' => 'ERROR - No Site Node Found'];
        }

        $this->view->assign('value', $status);
    }

}
