<?php

$http = eZHTTPTool::instance();


if (strrpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']))
{
    $res = array();
    $page = false;
    $limit = 100;
    $zoneName = array();
    $classIdentifier = false;
    if ( $http->hasPostVariable( 'node_id' ) )
    {
        $node = eZContentObjectTreeNode::fetch( $http->postVariable( 'node_id' ) );
 
        if ( $node instanceof eZContentObjectTreeNode )
            $object = $node->object();
        else
            $object = false;
        
        if ( $object instanceof eZContentObject )
        {
            $classID = $object->attribute( 'contentclass_id' );
            $classIdentifier = eZContentClass::classIdentifierByID( $classID );
        } else {
		header("Location: http://".$_SERVER['HTTP_HOST']);
	}
    	if ( $http->hasPostVariable( 'view' ) )
		header("Location: http://".$_SERVER['HTTP_HOST']."/content/view/".$http->postVariable( 'view' )."/".$node->attribute('node_id'));
	else
		header("Location: http://".$_SERVER['HTTP_HOST']."/".$node->urlAlias());
    }
}

eZExecution::cleanExit();

?>
