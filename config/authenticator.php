<?php

/*
 * (c) Yannis Sgarra <hello@yannissgarra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Webmunkeez\SecurityBundle\Authenticator\TokenAuthenticator;
use Webmunkeez\SecurityBundle\Provider\PrivateUserProviderInterface;
use Webmunkeez\SecurityBundle\Provider\PublicUserProviderInterface;
use Webmunkeez\SecurityBundle\Provider\UserProviderInterface;
use Webmunkeez\SecurityBundle\Token\TokenEncoderInterface;
use Webmunkeez\SecurityBundle\Token\TokenExtractorInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('webmunkeez_security.authenticator.session_token.public', TokenAuthenticator::class)
            ->args([
                service(TokenEncoderInterface::class),
                service(TokenExtractorInterface::class),
                service(PublicUserProviderInterface::class)
            ])
        ->set('webmunkeez_security.authenticator.session_token.private', TokenAuthenticator::class)
            ->args([
                service(TokenEncoderInterface::class),
                service(TokenExtractorInterface::class),
                service(PrivateUserProviderInterface::class)
            ]);
};
