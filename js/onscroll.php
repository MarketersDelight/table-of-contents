<script>

var toc = document.getElementById( '<?php echo $this->id; ?>' );

if ( toc === null ) return;

var active = 0,
	tocItems = toc.querySelectorAll( '.toc-item' ),
	headings = content.querySelectorAll( 'h2, h3, h4, h5, h6' );

for ( var i = 0; i < headings.length; i++ )
	if ( headings[i].offsetTop - contentBoxOffsetTop <= pos + 20 )
		active = i;

for ( var c = 0; c < tocItems.length; c++ )
	MD.removeClass( tocItems[c], 'active child-active' );

if ( tocItems[active] ) {
	MD.addClass( tocItems[active], 'active' );

	if ( MD.hasClass( tocItems[active].parentNode, 'toc-sublist' ) )
		MD.addClass( tocItems[active].parentNode.parentNode, 'child-active' );
}