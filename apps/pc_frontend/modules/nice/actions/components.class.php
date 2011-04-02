<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * nice actions.
 *
 * @package    OpenPNE
 * @subpackage nice
 * @author     H. Hishida<info@77-web.com>
 */
class niceComponents extends opNicePluginNiceComponents
{
  public function executeShow($request)
  {
    parent::executeShow($request);
    
    $this->getResponse()->addStylesheet('/opNicePlugin/css/nice.css');
  }
}
