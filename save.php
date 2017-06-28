<?php
$data = $_POST[ videoList ];
$playList = $_POST[ playlistId ];
/* create a dom document with encoding utf8 */
$domtree = new DOMDocument( '1.0', 'UTF-8' );

/* create the root element of the xml tree */
$xmlRoot = $domtree->createElement( "playlist" );
$xmlRoot = $domtree->appendChild( $xmlRoot );
$list = $domtree->createElement( "id", $playList );
$list = $xmlRoot->appendChild( $list );
/* append it to the document created */
foreach ( $data as $val ) {
    $currentTrack = $domtree->createElement( "video", $val );
    $currentTrack = $xmlRoot->appendChild( $currentTrack );
}
$domtree->save( $playList.".xml" );
?>