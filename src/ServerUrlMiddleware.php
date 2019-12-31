<?php

/**
 * @see       https://github.com/mezzio/mezzio-helpers for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-helpers/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-helpers/blob/master/LICENSE.md New BSD License
 */

namespace Mezzio\Helper;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Webimpress\HttpMiddlewareCompatibility\HandlerInterface as DelegateInterface;
use Webimpress\HttpMiddlewareCompatibility\MiddlewareInterface;

use const Webimpress\HttpMiddlewareCompatibility\HANDLER_METHOD;

class ServerUrlMiddleware implements MiddlewareInterface
{
    /**
     * @var ServerUrlHelper
     */
    private $helper;

    /**
     * @param ServerUrlHelper $helper
     */
    public function __construct(ServerUrlHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Inject the ServerUrlHelper instance with the request URI.
     *
     * Injects the ServerUrlHelper with the incoming request URI, and then invoke
     * the next middleware.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->helper->setUri($request->getUri());

        return $delegate->{HANDLER_METHOD}($request);
    }
}
