<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware.Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\OAuth\ResourceOwner;

/**
 * GoogleResourceOwner
 *
 * @author Geoffrey Bachelet <geoffrey.bachelet@gmail.com>
 * @author Alexander <iam.asm89@gmail.com>
 */
class GoogleResourceOwner extends GenericOAuth2ResourceOwner
{
    /**
     * {@inheritDoc}
     */
    protected $options = array(
        'authorization_url'       => 'https://accounts.google.com/o/oauth2/auth',
        'access_token_url'        => 'https://accounts.google.com/o/oauth2/token',
        'infos_url'               => 'https://www.googleapis.com/oauth2/v1/userinfo',

        'scope'                   => 'https://www.googleapis.com/auth/userinfo.profile',

        // @link https://developers.google.com/accounts/docs/OAuth2WebServer#offline
        'access_type'             => null,
        'request_visible_actions' => null,
        // sometimes we need to force for approval prompt (e.g. when we lost refresh token)
        'approval_prompt'         => null,
    );

    /**
     * {@inheritDoc}
     */
    protected $paths = array(
        'identifier'     => 'id',
        'nickname'       => 'name',
        'realname'       => 'name',
        'email'          => 'email',
        'profilepicture' => 'picture',
    );

    /**
     * {@inheritDoc}
     */
    public function getAuthorizationUrl($redirectUri, array $extraParameters = array())
    {
        return parent::getAuthorizationUrl($redirectUri, array_merge(array(
            'access_type'             => $this->getOption('access_type'),
            'approval_prompt'         => $this->getOption('approval_prompt'),
            'request_visible_actions' => $this->getOption('request_visible_actions')
        ), $extraParameters));
    }
}
