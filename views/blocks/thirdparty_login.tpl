[{$smarty.block.parent}]

[{assign var="oConfig" value=$oViewConf->getConfig()}]

<a href="[{$oConfig->getSelfLink()|cat:'cl=ssologincontroller'}]">single login</a>